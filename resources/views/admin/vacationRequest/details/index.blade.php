@extends('layouts.merge.admin')
@section('title', 'Detalhes do Pedido de Férias')
@section('content')
  <div class="row justify-content-center" style="margin-top: 1.5rem;">
    <div class="col-md-8">
      <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
          <span><i class="fas fa-file-alt me-2"></i>Detalhes do Pedido de Férias #{{ $data->id }}</span>
          <div>
            @if($data->approvalStatus == 'Aprovado' && $data->signedPdfPath)
              <a href="{{ route('admin.director.downloadSignedPdf', $data->id) }}" target="_blank"
                class="btn btn-outline-light btn-sm me-2" title="Pré-visualizar Guia">
                <i class="fas fa-file-pdf me-1"></i>Ver Guia
              </a>
            @endif
            <a href="{{ url()->previous() ?: route('admin.hr.pendingVacations') }}" class="btn btn-outline-light btn-sm"
              title="Voltar">
              <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
          </div>
        </div>
        <div class="card-body">

          {{-- DADOS DO PEDIDO --}}
          <h6 class="text-muted text-uppercase fw-bold mb-3">
            <i class="fas fa-info-circle me-1"></i>Informações do Pedido
          </h6>
          <table class="table table-bordered mb-4">
            <tr>
              <th class="bg-light" style="width: 35%">Funcionário</th>
              <td class="fw-bold">{{ $data->employee->fullName ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Departamento</th>
              <td>{{ $data->employee->department->title ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Cargo</th>
              <td>{{ $data->employee->position->name ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Tipo de Férias</th>
              <td><span class="badge bg-secondary">{{ $data->vacationType }}</span></td>
            </tr>
            <tr>
              <th class="bg-light">Data de Início</th>
              <td>{{ \Carbon\Carbon::parse($data->vacationStart)->format('d/m/Y') }}</td>
            </tr>
            <tr>
              <th class="bg-light">Data de Fim</th>
              <td>{{ \Carbon\Carbon::parse($data->vacationEnd)->format('d/m/Y') }}</td>
            </tr>
            <tr>
              <th class="bg-light">Razão / Justificação</th>
              <td>{{ $data->reason ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Documento Anexo</th>
              <td>
                @if($data->supportDocument)
                  <a href="{{ asset('storage/' . $data->supportDocument) }}" target="_blank" class="text-primary">
                    <i class="fas fa-paperclip me-1"></i>{{ $data->originalFileName ?? 'Ver Documento' }}
                  </a>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
            </tr>
            <tr>
              <th class="bg-light">Status Actual</th>
              <td>
                @if($data->approvalStatus == 'Aprovado')
                  <span class="badge bg-success fs-6">Aprovado</span>
                @elseif($data->approvalStatus == 'Pendente')
                  <span class="badge bg-warning text-dark fs-6">Pendente</span>
                @elseif($data->approvalStatus == 'Recusado')
                  <span class="badge bg-danger fs-6">Recusado</span>
                @elseif($data->approvalStatus == 'Validado pelo Chefe')
                  <span class="badge bg-info fs-6">Validado pelo Chefe</span>
                @elseif($data->approvalStatus == 'Encaminhado')
                  <span class="badge bg-primary fs-6">Encaminhado</span>
                @else
                  <span class="badge bg-secondary fs-6">{{ $data->approvalStatus }}</span>
                @endif
              </td>
            </tr>
            <tr>
              <th class="bg-light">Criado em</th>
              <td>{{ $data->created_at->format('d/m/Y H:i') }}</td>
            </tr>
          </table>

          {{-- HISTÓRICO DE TRAMITAÇÃO --}}
          <h6 class="text-muted text-uppercase fw-bold mb-3">
            <i class="fas fa-history me-1"></i>Histórico de Tramitação
          </h6>
          <div class="timeline-history mb-3">

            {{-- 1. Submissão do funcionário --}}
            <div class="d-flex mb-3">
              <div class="flex-shrink-0 me-3">
                <span class="badge bg-secondary rounded-pill p-2"><i class="fas fa-paper-plane"></i></span>
              </div>
              <div class="flex-grow-1">
                <p class="mb-0 fw-bold">Pedido submetido pelo funcionário</p>
                <small class="text-muted">{{ $data->created_at->format('d/m/Y \à\s H:i') }}</small>
              </div>
            </div>

            {{-- 2. Validação / Rejeição do Chefe de Departamento --}}
            @if($data->approvalComment && !str_starts_with($data->approvalComment, 'Recusado pelo Director'))
              <div class="d-flex mb-3">
                <div class="flex-shrink-0 me-3">
                  <span class="badge bg-info rounded-pill p-2"><i class="fas fa-user-tie"></i></span>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0 fw-bold">Parecer do Chefe de Departamento
                    @if($data->employee->department && $data->employee->department->head)
                      <small class="text-muted fw-normal">({{ $data->employee->department->head->fullName ?? '' }})</small>
                    @endif
                  </p>
                  <p class="mb-0 text-muted">{{ $data->approvalComment }}</p>
                </div>
              </div>
            @endif

            {{-- 3. Encaminhamento pela Área Administrativa (RH) --}}
            @if($data->forwarded_to_director_id)
              <div class="d-flex mb-3">
                <div class="flex-shrink-0 me-3">
                  <span class="badge bg-primary rounded-pill p-2"><i class="fas fa-share"></i></span>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0 fw-bold">Encaminhado pela Área Administrativa (RH)</p>
                  <small class="text-muted">Enviado ao Director para decisão final</small>
                </div>
              </div>
            @endif

            {{-- 4. Alterações do RH (feriados manuais) --}}
            @if($data->manualHolidays && count($data->manualHolidays) > 0)
              <div class="d-flex mb-3">
                <div class="flex-shrink-0 me-3">
                  <span class="badge bg-warning text-dark rounded-pill p-2"><i class="fas fa-calendar-check"></i></span>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0 fw-bold">Feriados ajustados pelo RH</p>
                  <ul class="list-unstyled mb-0">
                    @foreach($data->manualHolidays as $holiday)
                      <li><small class="text-muted">• {{ $holiday }}</small></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            @endif

            {{-- 5. Decisão final do Director --}}
            @if($data->approvalStatus == 'Aprovado')
              <div class="d-flex mb-3">
                <div class="flex-shrink-0 me-3">
                  <span class="badge bg-success rounded-pill p-2"><i class="fas fa-check-double"></i></span>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0 fw-bold text-success">Aprovado pelo Director</p>
                  @if($data->signedPdfPath)
                    <small class="text-muted">Guia de Férias gerada</small>
                  @endif
                  <br>
                  <small class="text-muted">{{ $data->updated_at->format('d/m/Y \à\s H:i') }}</small>
                </div>
              </div>
            @elseif($data->approvalStatus == 'Recusado')
              <div class="d-flex mb-3">
                <div class="flex-shrink-0 me-3">
                  <span class="badge bg-danger rounded-pill p-2"><i class="fas fa-times"></i></span>
                </div>
                <div class="flex-grow-1">
                  <p class="mb-0 fw-bold text-danger">Pedido Recusado</p>
                  @if($data->rejectionReason)
                    <p class="mb-0"><small class="text-muted">Motivo: {{ $data->rejectionReason }}</small></p>
                  @endif
                  <small class="text-muted">{{ $data->updated_at->format('d/m/Y \à\s H:i') }}</small>
                </div>
              </div>
            @endif

          </div>

        </div>
      </div>
    </div>
  </div>
@endsection