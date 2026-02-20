<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VacationRequest;
use App\Models\Admin;
use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdministrativeAreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista pedidos validados pelo chefe de departamento
    public function pendingVacations(Request $request)
    {
        $user = Auth::user();
        if (!$this->hasRhAccess($user)) {
            abort(403, 'Acesso negado.');
        }

        $from = $request->input('from');
        $to = $request->input('to');
        $employeeId = $request->input('employeeId');

        $query = VacationRequest::where('approvalStatus', 'Validado');

        if ($from && $to) {
            $query->whereBetween('created_at', [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay(),
            ]);
        }

        if ($employeeId) {
            $query->where('employeeId', $employeeId);
        }

        $pendingRequests = $query->with('employee')->orderByDesc('id')->get();

        // Carregar Directores para o select — usa Admin (tabela admins que tem coluna role)
        $directors = Admin::where('role', 'director')->with('employee')->get();

        return view('administrativeArea.pendingVacations', compact('pendingRequests', 'from', 'to', 'employeeId', 'directors'));
    }

    // Encaminha o pedido para o Diretor Geral
    public function forwardVacation($id, Request $request)
    {
        $user = Auth::user();
        if (!$this->hasRhAccess($user)) {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'forwarded_to_director_id' => 'required|exists:admins,id',
        ]);

        $vacation = VacationRequest::findOrFail($id);

        // Retificação de datas se fornecidas
        if ($request->filled('vacationStart')) {
            $vacation->vacationStart = $request->vacationStart;

            // Recalcular data de fim baseada no tipo de férias
            $start = Carbon::parse($request->vacationStart);
            $needed = intval(explode(' ', $vacation->vacationType)[0]);
            $holidays = $vacation->manualHolidays ?? [];

            $end = $start->copy();
            $count = 0;
            while ($count < $needed) {
                $end->addDay();
                if ($end->isWeekend())
                    continue;
                if (in_array($end->toDateString(), $holidays))
                    continue;
                $count++;
            }
            if ($end->isWeekend()) {
                $end->next(Carbon::MONDAY);
            }
            $vacation->vacationEnd = $end->toDateString();
        }

        $vacation->approvalStatus = 'Encaminhado';
        $vacation->approvalComment = $request->input('approvalComment') ?? 'Encaminhado pela Área Administrativa';
        $vacation->forwarded_to_director_id = $request->forwarded_to_director_id;
        $vacation->save();

        return redirect()->route('admin.hr.pendingVacations')
            ->with('success', 'Pedido de férias encaminhado para o Diretor Geral com sucesso!');
    }

    /**
     * Verifica se o utilizador tem acesso à Área Administrativa (RH).
     * Permite: admin, hr, ou department_head/employee do DASG/RH.
     */
    private function hasRhAccess($user)
    {
        // Admin e HR têm acesso direto
        if (in_array($user->role, ['admin', 'hr'])) {
            return true;
        }

        // department_head ou employee do departamento DASG/RH
        if (in_array($user->role, ['department_head', 'employee'])) {
            $department = null;

            // Tentar via department_id direto no admin
            if ($user->department_id) {
                $department = Department::find($user->department_id);
            }

            // Tentar via employee->department
            if (!$department && $user->employee && $user->employee->departmentId) {
                $department = Department::find($user->employee->departmentId);
            }

            if ($department) {
                $title = Str::lower($department->title);
                if (Str::contains($title, ['recursos humanos', 'rh', 'administrativa', 'administração e serviços gerais', 'dasg'])) {
                    return true;
                }
            }
        }

        return false;
    }
}
