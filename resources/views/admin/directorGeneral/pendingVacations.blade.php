@extends('layouts.merge.admin')
@section('title', 'Pedidos de Férias - Direção Geral')
@section('content')

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-gavel me-2"></i>Pedidos de Férias para Decisão Final</h5>
      <span class="badge bg-white text-dark fs-6">{{ $pendingRequests->count() }} pedido(s)</span>
    </div>
    <div class="card-body">

      {{-- Flash messages --}}
      @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('msg') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- TABELA --}}
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Funcionário</th>
              <th>Tipo</th>
              <th>Início / Fim</th>
              <th>Status</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pendingRequests as $req)
              <tr>
                <td><span class="fw-semibold text-muted">{{ $req->id }}</span></td>
                <td>
                  <div class="d-flex flex-column">
                    <span class="fw-bold">{{ $req->employee->fullName ?? '-' }}</span>
                    <small class="text-muted">{{ $req->employee->department->title ?? '' }}</small>
                  </div>
                </td>
                <td><span class="badge bg-secondary">{{ $req->vacationType }}</span></td>
                <td>
                  <div class="d-flex flex-column">
                    <small>Início:
                      <strong>{{ \Carbon\Carbon::parse($req->vacationStart)->format('d/m/Y') }}</strong></small>
                    <small class="text-muted">Fim: {{ \Carbon\Carbon::parse($req->vacationEnd)->format('d/m/Y') }}</small>
                  </div>
                </td>
                <td><span class="badge bg-warning text-dark">{{ $req->approvalStatus }}</span></td>

                {{-- COLUNA AÇÕES (DROPDOWN OPERAÇÕES) --}}
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                      aria-expanded="false">
                      <i class="fas fa-cog me-1"></i>Operações
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                      <li>
                        <a class="dropdown-item" href="{{ route('admin.vacationRequests.show', $req->id) }}">
                          <i class="fas fa-eye me-2 text-info"></i>Detalhes
                        </a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <button type="button" class="dropdown-item text-success" data-bs-toggle="modal"
                          data-bs-target="#approveModal-{{ $req->id }}">
                          <i class="fas fa-check-circle me-2"></i>Aprovar
                        </button>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal"
                          data-bs-target="#rejectModal-{{ $req->id }}">
                          <i class="fas fa-times-circle me-2"></i>Rejeitar
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>

              {{-- MODAL APROVAR --}}
              <div class="modal fade" id="approveModal-{{ $req->id }}" tabindex="-1"
                aria-labelledby="approveModalLabel-{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('admin.director.approveVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="approveModalLabel-{{ $req->id }}">
                          <i class="fas fa-check-circle me-2"></i>Aprovar Pedido #{{ $req->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                          aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label fw-semibold text-muted">Funcionário</label>
                          <p class="mb-0 fw-bold">{{ $req->employee->fullName ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold text-muted">Período</label>
                          <p class="mb-0">
                            {{ \Carbon\Carbon::parse($req->vacationStart)->format('d/m/Y') }} até
                            {{ \Carbon\Carbon::parse($req->vacationEnd)->format('d/m/Y') }}
                          </p>
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold text-muted">Tipo</label>
                          <p class="mb-0"><span class="badge bg-secondary">{{ $req->vacationType }}</span></p>
                        </div>
                        <hr>
                        <div class="mb-3">
                          <label for="approvalComment-{{ $req->id }}" class="form-label fw-semibold">Comentário
                            (opcional)</label>
                          <textarea name="approvalComment" id="approvalComment-{{ $req->id }}" class="form-control" rows="2"
                            placeholder="Observação ao aprovar..."></textarea>
                        </div>
                        <div class="alert alert-info mb-0">
                          <i class="fas fa-info-circle me-2"></i>Ao aprovar, a Guia de Férias será gerada e assinada
                          automaticamente.
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                          <i class="fas fa-check me-1"></i>Confirmar Aprovação
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              {{-- MODAL REJEITAR --}}
              <div class="modal fade" id="rejectModal-{{ $req->id }}" tabindex="-1"
                aria-labelledby="rejectModalLabel-{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('admin.director.rejectVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="rejectModalLabel-{{ $req->id }}">
                          <i class="fas fa-times-circle me-2"></i>Rejeitar Pedido #{{ $req->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                          aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <div class="mb-3">
                          <label class="form-label fw-semibold text-muted">Funcionário</label>
                          <p class="mb-0 fw-bold">{{ $req->employee->fullName ?? '-' }}</p>
                        </div>
                        <div class="mb-3">
                          <label for="rejectionReason-{{ $req->id }}" class="form-label fw-semibold">
                            Motivo da Rejeição <span class="text-danger">*</span>
                          </label>
                          <textarea name="rejectionReason" id="rejectionReason-{{ $req->id }}" class="form-control" rows="3"
                            required placeholder="Explique o porquê da recusa..."></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">
                          <i class="fas fa-times me-1"></i>Confirmar Rejeição
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                  <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                  Nenhum pedido aguardando decisão final.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>

@endsection