@extends('layouts.merge.admin')
@section('title', 'Pedidos de Férias - Área Administrativa')
@section('content')

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-umbrella-beach me-2"></i>Pedidos de Férias para Encaminhamento (RH)</h5>
      <span class="badge bg-white text-info fs-6">{{ $pendingRequests->count() }} pedido(s)</span>
    </div>
    <div class="card-body">

      {{-- Flash messages --}}
      @if(session('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('msg') }}
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

      {{-- FILTROS --}}
      <form method="GET" action="{{ route('admin.hr.pendingVacations') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-3">
          <label for="from" class="form-label fw-semibold">De</label>
          <input type="date" name="from" id="from" value="{{ $from }}" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="to" class="form-label fw-semibold">Até</label>
          <input type="date" name="to" id="to" value="{{ $to }}" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="employeeId" class="form-label fw-semibold">Funcionário (ID)</label>
          <input type="text" name="employeeId" id="employeeId" value="{{ $employeeId }}" class="form-control"
            placeholder="ID do Funcionário">
        </div>
        <div class="col-md-3 d-flex gap-2 align-self-end">
          <button type="submit" class="btn btn-primary flex-fill">
            <i class="fas fa-search me-1"></i>Filtrar
          </button>
          <a href="{{ route('admin.hr.pendingVacations') }}" class="btn btn-outline-secondary flex-fill">
            <i class="fas fa-sync me-1"></i>Limpar
          </a>
        </div>
      </form>

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
                <td><span class="badge bg-info">{{ $req->approvalStatus }}</span></td>

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
                        <a class="dropdown-item" href="{{ route('admin.vacationRequests.edit', $req->id) }}">
                          <i class="fas fa-edit me-2 text-warning"></i>Editar / Retificar
                        </a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li>
                      <li>
                        <button type="button" class="dropdown-item text-primary" data-bs-toggle="modal"
                          data-bs-target="#forwardModal-{{ $req->id }}">
                          <i class="fas fa-share me-2"></i>Encaminhar
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>

              {{-- MODAL ENCAMINHAR --}}
              <div class="modal fade" id="forwardModal-{{ $req->id }}" tabindex="-1"
                aria-labelledby="forwardModalLabel-{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form action="{{ route('admin.hr.forwardVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="forwardModalLabel-{{ $req->id }}">
                          <i class="fas fa-share me-2"></i>Encaminhar Pedido #{{ $req->id }}
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
                          <label for="director-{{ $req->id }}" class="form-label fw-semibold">
                            Encaminhar para Diretor <span class="text-danger">*</span>
                          </label>
                          <select name="forwarded_to_director_id" id="director-{{ $req->id }}" class="form-select" required>
                            <option value="">-- Selecione o Diretor --</option>
                            @foreach($directors as $director)
                              <option value="{{ $director->id }}">
                                {{ $director->directorName ?? ($director->employee->fullName ?? $director->email) }}
                              </option>
                            @endforeach
                          </select>
                        </div>

                        <hr>
                        <p class="text-muted small mb-2"><i class="fas fa-calendar-alt me-1"></i>Retificação de datas
                          (opcional)</p>

                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label for="start_date-{{ $req->id }}" class="form-label fw-semibold">Nova Data Início</label>
                            <input type="date" name="start_date" id="start_date-{{ $req->id }}" class="form-control"
                              value="{{ $req->vacationStart }}">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="end_date-{{ $req->id }}" class="form-label fw-semibold">Nova Data Fim</label>
                            <input type="date" name="end_date" id="end_date-{{ $req->id }}" class="form-control"
                              value="{{ $req->vacationEnd }}">
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="comment-{{ $req->id }}" class="form-label fw-semibold">Comentário (opcional)</label>
                          <textarea name="approvalComment" id="comment-{{ $req->id }}" class="form-control" rows="2"
                            placeholder="Observação ao encaminhar..."></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fas fa-paper-plane me-1"></i>Encaminhar
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
                  Nenhum pedido validado pelo chefe de departamento.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>

@endsection