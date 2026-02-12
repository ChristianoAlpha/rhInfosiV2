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
        <div class="col-md-4">
          <label for="from" class="form-label fw-semibold">De</label>
          <input type="date" name="from" id="from" value="{{ $from }}" class="form-control">
        </div>
        <div class="col-md-4">
          <label for="to" class="form-label fw-semibold">Até</label>
          <input type="date" name="to" id="to" value="{{ $to }}" class="form-control">
        </div>
        <div class="col-md-3">
          <label for="employeeId" class="form-label">Funcionário (ID)</label>
          <input type="text" name="employeeId" id="employeeId" value="{{ $employeeId }}" class="form-control"
            placeholder="ID do Funcionário">
        </div>
        <div class="col-md-3 align-self-end">
          <button type="submit" class="btn btn-primary">
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
              <th>#</th>
              <th>Funcionário</th>
              <th>Tipo</th>
              <th>Início</th>
              <th>Fim</th>
              <th>Status</th>
              <th class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pendingRequests as $req)
              <tr>
                <td><span class="fw-semibold text-muted">{{ $req->id }}</span></td>
                <td>{{ $req->employee->fullName ?? '-' }}</td>
                <td><span class="badge bg-secondary">{{ $req->vacationType }}</span></td>
                <td>{{ \Carbon\Carbon::parse($req->vacationStart)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($req->vacationEnd)->format('d/m/Y') }}</td>
                <td><span class="badge bg-info">{{ $req->approvalStatus }}</span></td>
                <td>
                  <form id="forward-form-{{ $req->id }}" action="{{ route('admin.hr.forwardVacation', $req->id) }}"
                    method="POST">
                    @csrf
                    <input type="date" name="vacationStart" class="form-control form-control-sm"
                      value="{{ $req->vacationStart }}">
                </td>
                <td>
                  <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-share"></i> Encaminhar
                  </button>
                  </form>
                </td>
              </tr>

              {{-- MODAL ENCAMINHAR --}}
              <div class="modal fade" id="modalEncaminhar{{ $req->id }}" tabindex="-1"
                aria-labelledby="labelEncaminhar{{ $req->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <form action="{{ route('admin.hr.forwardVacation', $req->id) }}" method="POST">
                      @csrf
                      <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="labelEncaminhar{{ $req->id }}">
                          <i class="fas fa-share me-2"></i>Encaminhar Pedido #{{ $req->id }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        {{-- Info do pedido --}}
                        <div class="alert alert-light border mb-3">
                          <div class="row">
                            <div class="col-6">
                              <small class="text-muted d-block">Funcionário</small>
                              <strong>{{ $req->employee->fullName ?? '-' }}</strong>
                            </div>
                            <div class="col-3">
                              <small class="text-muted d-block">Início</small>
                              <strong>{{ \Carbon\Carbon::parse($req->vacationStart)->format('d/m/Y') }}</strong>
                            </div>
                            <div class="col-3">
                              <small class="text-muted d-block">Fim</small>
                              <strong>{{ \Carbon\Carbon::parse($req->vacationEnd)->format('d/m/Y') }}</strong>
                            </div>
                          </div>
                        </div>

                        {{-- Retificação de datas --}}
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Retificar Data de Início <small
                              class="text-muted">(opcional)</small></label>
                          <input type="date" name="start_date" class="form-control" value="{{ $req->vacationStart }}">
                        </div>
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Retificar Data de Fim <small
                              class="text-muted">(opcional)</small></label>
                          <input type="date" name="end_date" class="form-control" value="{{ $req->vacationEnd }}">
                        </div>

                        {{-- Select Diretor --}}
                        <div class="mb-3">
                          <label class="form-label fw-semibold">Diretor <span class="text-danger">*</span></label>
                          <select name="forwarded_to_director_id" class="form-select" required>
                            <option value="">-- Selecione o Diretor --</option>
                            @foreach($directors as $director)
                              <option value="{{ $director->id }}">
                                {{ $director->directorName ?? ($director->employee->fullName ?? $director->email) }}
                              </option>
                            @endforeach
                          </select>
                          <div class="form-text">Obrigatório. O pedido será encaminhado para este diretor.</div>
                        </div>

                        {{-- Comentário --}}
                        <div class="mb-0">
                          <label class="form-label fw-semibold">Comentário <small
                              class="text-muted">(opcional)</small></label>
                          <textarea name="approvalComment" class="form-control" rows="2"
                            placeholder="Observações para o diretor..."></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fas fa-share me-1"></i>Encaminhar
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            @empty
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">
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