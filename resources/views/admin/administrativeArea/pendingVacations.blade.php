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

      {{-- FILTROS (sem campo ID funcionário) --}}
      <form method="GET" action="{{ route('admin.hr.pendingVacations') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
          <label for="from" class="form-label fw-semibold">De</label>
          <input type="date" name="from" id="from" value="{{ $from }}" class="form-control">
        </div>
        <div class="col-md-4">
          <label for="to" class="form-label fw-semibold">Até</label>
          <input type="date" name="to" id="to" value="{{ $to }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex gap-2">
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
              <th>#</th>
              <th>Funcionário</th>
              <th>Tipo</th>
              <th>Início / Fim</th>
              <th>Status</th>
              <th>Encaminhar para</th>
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

                {{-- ENCAMINHAR INLINE (select + botão direto) --}}
                <td>
                  <form action="{{ route('admin.hr.forwardVacation', $req->id) }}" method="POST"
                    class="d-flex align-items-center gap-2" id="forwardForm-{{ $req->id }}">
                    @csrf
                    <select name="forwarded_to_director_id" class="form-select form-select-sm" required
                      style="min-width: 180px;">
                      <option value="">-- Diretor --</option>
                      @foreach($directors as $director)
                        <option value="{{ $director->id }}">
                          {{ $director->directorName ?? ($director->employee->fullName ?? $director->email) }}
                        </option>
                      @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary" title="Encaminhar">
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </form>
                </td>

                {{-- DROPDOWN AÇÕES --}}
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
                    </ul>
                  </div>
                </td>
              </tr>
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