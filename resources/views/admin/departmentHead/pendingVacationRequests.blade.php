@extends('layouts.merge.admin')
@section('title', 'Pedidos de Férias Pendentes')
@section('content')

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-umbrella-beach me-2"></i>Pedidos de Férias Pendentes</h5>
      <span class="badge bg-white text-secondary fs-6">{{ $pendingRequests->count() }} pedido(s)</span>
    </div>
    <div class="card-body">

      @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('msg') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      {{-- FILTRO POR DATAS --}}
      <form method="GET" action="{{ route('dh.pendingVacations') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
          <label for="from" class="form-label fw-semibold">De</label>
          <input type="date" name="from" id="from" value="{{ old('from', $from) }}" class="form-control">
        </div>
        <div class="col-md-4">
          <label for="to" class="form-label fw-semibold">Até</label>
          <input type="date" name="to" id="to" value="{{ old('to', $to) }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button type="submit" class="btn btn-outline-secondary flex-fill">
            <i class="fas fa-search me-1"></i>Filtrar
          </button>
          <a href="{{ route('dh.pendingVacations') }}" class="btn btn-secondary flex-fill">
            <i class="fas fa-sync me-1"></i>Limpar
          </a>
        </div>
      </form>

      {{-- TABELA --}}
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Funcionário</th>
              <th>Tipo</th>
              <th>Início / Fim</th>
              <th>Status</th>
              <th class="text-center">Operações</th>
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
                <td>
                  @if($req->approvalStatus == 'Aprovado')
                    <span class="badge bg-success">Aprovado</span>
                  @elseif($req->approvalStatus == 'Pendente')
                    <span class="badge bg-warning text-dark">Pendente</span>
                  @elseif($req->approvalStatus == 'Recusado')
                    <span class="badge bg-danger">Recusado</span>
                  @else
                    <span class="badge bg-info">{{ $req->approvalStatus }}</span>
                  @endif
                </td>

                {{-- DROPDOWN OPERAÇÕES --}}
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
                          data-bs-target="#validateModal-{{ $req->id }}">
                          <i class="fas fa-check-circle me-2"></i>Validar
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

              {{-- MODAL VALIDAR --}}
              <div class="modal fade" id="validateModal-{{ $req->id }}" tabindex="-1"
                aria-labelledby="validateLabel-{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('dh.approveVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="validateLabel-{{ $req->id }}">
                          <i class="fas fa-check-circle me-2"></i>Validar Pedido #{{ $req->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                          aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <p>Confirma a validação do pedido de férias de
                          <strong>{{ $req->employee->fullName ?? '-' }}</strong>?
                        </p>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Comentário (opcional)</label>
                          <textarea name="approvalComment" class="form-control" rows="2"
                            placeholder="Observação ao validar..."></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                          <i class="fas fa-check me-1"></i>Confirmar Validação
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              {{-- MODAL REJEITAR --}}
              <div class="modal fade" id="rejectModal-{{ $req->id }}" tabindex="-1"
                aria-labelledby="rejectLabel-{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('dh.rejectVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="rejectLabel-{{ $req->id }}">
                          <i class="fas fa-times-circle me-2"></i>Rejeitar Pedido #{{ $req->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                          aria-label="Fechar"></button>
                      </div>
                      <div class="modal-body">
                        <p>Rejeitar pedido de férias de <strong>{{ $req->employee->fullName ?? '-' }}</strong>?</p>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Motivo da rejeição <span
                              class="text-danger">*</span></label>
                          <textarea name="approvalComment" class="form-control" rows="3" required minlength="5"
                            placeholder="Informe o motivo da rejeição..."></textarea>
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
                  Nenhum pedido de férias pendente.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>

@endsection