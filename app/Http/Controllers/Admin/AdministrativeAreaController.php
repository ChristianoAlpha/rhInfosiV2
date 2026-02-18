<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            $query->whereBetween('created_at', [Carbon::parse($from)->startOfDay(), Carbon::parse($to)->endOfDay()]);
        }

        if ($employeeId) {
            $query->where('employeeId', $employeeId);
        }

        $pendingRequests = $query->with('employee')->orderByDesc('id')->get();

        // Carregar diretores para o select — usa Admin (tabela admins que tem coluna role)
        $directors = Admin::where('role', 'director')->with('employee')->get();

        return view('admin.administrativeArea.pendingVacations', compact('pendingRequests', 'from', 'to', 'employeeId', 'directors'));
    }

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

        if ($request->filled('start_date')) {
            $vacation->vacationStart = $request->start_date;

            $start = Carbon::parse($request->start_date);
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

        if ($request->filled('end_date')) {
            $vacation->vacationEnd = $request->end_date;
        }

        $vacation->approvalStatus = 'Encaminhado';
        $vacation->approvalComment = $request->input('approvalComment') ?? 'Encaminhado pela Área Administrativa';
        $vacation->forwarded_to_director_id = $request->forwarded_to_director_id;
        $vacation->save();

        return redirect()->route('admin.hr.pendingVacations')->with('success', 'Pedido encaminhado com sucesso!');
    }

    /**
     * Verifica se o utilizador tem acesso à Área Administrativa (RH).
     * Permite: admin, hr, ou department_head/employee do DASG/RH.
     */
    private function hasRhAccess($user)
    {
        if (in_array($user->role, ['admin', 'hr'])) {
            return true;
        }

        if (in_array($user->role, ['department_head', 'employee'])) {
            $department = null;

            if ($user->department_id) {
                $department = Department::find($user->department_id);
            }

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