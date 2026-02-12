<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VacationRequest;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DirectorGeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista pedidos encaminhados pelo RH
    public function pendingVacations(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'director' && $user->role !== 'admin') {
            abort(403, 'Acesso negado.');
        }

        $from = $request->input('from');
        $to = $request->input('to');

        $query = VacationRequest::where('approvalStatus', 'Encaminhado');

        // Se for diretor, filtrar apenas os encaminhados para ele
        if ($user->role === 'director') {
            $query->where('forwarded_to_director_id', $user->id);
        }

        if ($from && $to) {
            $query->whereBetween('created_at', [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay(),
            ]);
        }

        $pendingRequests = $query->with('employee')->orderByDesc('id')->get();

        return view('directorGeneral.pendingVacations', compact('pendingRequests', 'from', 'to'));
    }

    // Aprovação Final pelo Diretor Geral
    public function approveVacation($id, Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'director' && $user->role !== 'admin') {
            abort(403, 'Acesso negado.');
        }

        $vacation = VacationRequest::with('employee.department', 'employee.position')->findOrFail($id);

        // Verificar se foi encaminhado para este diretor
        if ($user->role === 'director' && $vacation->forwarded_to_director_id !== $user->id) {
            abort(403, 'Este pedido não foi encaminhado para você.');
        }

        $vacation->approvalStatus = 'Aprovado';
        $vacation->approvalComment = $request->input('approvalComment') ?? 'Aprovado pelo Diretor Geral';

        // Identificar o prefixo e cargo com base no utilizador logado (Director)
        $directorName = $user->name;
        $prefix = 'DG-INFOSI'; // Default
        $headerTitle = 'GABINETE DO DIRECTOR GERAL';
        $signerTitle = 'O DIRECTOR GERAL';

        // Lógica baseada no nome do Diretor
        if (str_contains($directorName, 'Marcos Cary')) {
            $prefix = 'DGAAT-INFOSI';
            $headerTitle = 'GABINETE DO DIRECTOR GERAL ADJUNTO PARA ÁREA TÉCNICA';
            $signerTitle = 'O DIRECTOR GERAL ADJUNTO PARA ÁREA TÉCNICA';
        } elseif (str_contains($directorName, 'Rita Patrícia')) {
            $prefix = 'DGAA-INFOSI';
            $headerTitle = 'GABINETE DA DIRECTORA GERAL ADJUNTA PARA ÁREA ADMINISTRATIVA E FINANCEIRA';
            $signerTitle = 'A DIRECTORA GERAL ADJUNTA PARA ÁREA ADMINISTRATIVA E FINANCEIRA';
        } elseif (str_contains($directorName, 'André Mpumba')) {
            $prefix = 'DG-INFOSI';
            $headerTitle = 'GABINETE DO DIRECTOR GERAL';
            $signerTitle = 'O DIRECTOR GERAL';
        }

        // Contar aprovações deste diretor neste ano para gerar sequencial
        $year = Carbon::now()->year;
        $count = VacationRequest::where('forwarded_to_director_id', $user->id)
            ->where('approvalStatus', 'Aprovado')
            ->whereYear('updated_at', $year)
            ->count();

        $sequence = $count + 1;
        $sequenceNumber = sprintf('%03d/%s/%s', $sequence, $prefix, $year);

        // --- GERAÇÃO DO PDF ---
        $data = [
            'vacation' => $vacation,
            'employee' => $vacation->employee,
            'sequenceNumber' => $sequenceNumber,
            'headerTitle' => $headerTitle,
            'signerTitle' => $signerTitle,
            'directorName' => $directorName,
            'approvalDate' => Carbon::now(),
            'emissionDate' => Carbon::now(),
        ];

        $pdf = PDF::loadView('admin.vacationRequests.pdf.guide', $data)
            ->setPaper('a4', 'portrait');

        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $vacation->employee->fullName);
        $fileName = 'Guia_Ferias_' . $sequence . '_' . $safeName . '_' . $year . '.pdf';
        $path = 'vacation_guides/' . $fileName;

        Storage::disk('public')->put($path, $pdf->output());

        $vacation->signedPdfPath = $path;
        $vacation->save();

        return redirect()->route('admin.director.pendingVacations')
            ->with('msg', 'Pedido de férias aprovado e Guia gerada com sucesso! (' . $sequenceNumber . ')');
    }

    // Rejeição pelo Diretor Geral
    public function rejectVacation($id, Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'director' && $user->role !== 'admin') {
            abort(403, 'Acesso negado.');
        }

        $request->validate([
            'rejectionReason' => 'required|string|min:5'
        ]);

        $vacation = VacationRequest::findOrFail($id);
        $vacation->approvalStatus = 'Recusado';
        $vacation->rejectionReason = $request->rejectionReason;
        $vacation->approvalComment = 'Recusado pelo Diretor Geral: ' . $request->rejectionReason;
        $vacation->save();

        return redirect()->route('admin.director.pendingVacations')
            ->with('msg', 'Pedido de férias recusado.');
    }
}
