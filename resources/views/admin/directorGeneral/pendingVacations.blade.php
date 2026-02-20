@extends('layouts.merge.admin')
@section('title', 'Pedidos de Férias - Direcção Geral')
@section('content')

  <div class="card mb-4 shadow-sm">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
      <h5 class="mb-0"><i class="fas fa-gavel me-2"></i>Pedidos de Férias para Decisão Final</h5>
      <span class="badge bg-white text-dark fs-6">{{ $pendingRequests->count() }} pedido(s)</span>
    </div>
    <div class="card-body">

      {{-- Flash messages handled by globalModal via @include('extra._alerts.index') --}}

      {{-- FILTRO POR DATAS --}}
      <form method="GET" action="{{ route('admin.director.pendingVacations') }}" class="row g-3 mb-4 align-items-end">
        <div class="col-md-4">
          <label for="from" class="form-label fw-semibold">De</label>
          <input type="date" name="from" id="from" value="{{ $from ?? '' }}" class="form-control">
        </div>
        <div class="col-md-4">
          <label for="to" class="form-label fw-semibold">Até</label>
          <input type="date" name="to" id="to" value="{{ $to ?? '' }}" class="form-control">
        </div>
        <div class="col-md-4 d-flex gap-2">
          <button type="submit" class="btn btn-outline-secondary flex-fill">
            <i class="fas fa-search me-1"></i>Filtrar
          </button>
          <a href="{{ route('admin.director.pendingVacations') }}" class="btn btn-secondary flex-fill">
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
                <td><span class="badge bg-warning text-dark">{{ $req->approvalStatus }}</span></td>

                {{-- DROPDOWN OPERAÇÕES — usa globalModal via JS --}}
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
                        <button type="button" class="dropdown-item text-success"
                          onclick="openApproveModal({{ $req->id }}, '{{ addslashes($req->employee->fullName ?? '-') }}', '{{ \Carbon\Carbon::parse($req->vacationStart)->format('d/m/Y') }}', '{{ \Carbon\Carbon::parse($req->vacationEnd)->format('d/m/Y') }}', '{{ $req->vacationType }}')">
                          <i class="fas fa-check-circle me-2"></i>Aprovar
                        </button>
                      </li>
                      <li>
                        <button type="button" class="dropdown-item text-danger"
                          onclick="openRejectModal({{ $req->id }}, '{{ addslashes($req->employee->fullName ?? '-') }}')">
                          <i class="fas fa-times-circle me-2"></i>Rejeitar
                        </button>
                      </li>
                    </ul>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4 text-muted">
                  <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                  Nenhum pedido a aguardar decisão final.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    </div>
  </div>

  {{-- Forms ocultos para submit --}}
  <form id="approveForm" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="approvalComment" id="approveCommentInput">
  </form>
  <form id="rejectForm" method="POST" style="display:none;">
    @csrf
    <input type="hidden" name="rejectionReason" id="rejectReasonInput">
  </form>

@endsection

@section('scripts')
  <script>
    /**
     * Aprovar — usa globalModal existente (sem modal Bootstrap extra)
     */
    function openApproveModal(id, empName, dateStart, dateEnd, vacType) {
      var bodyHtml = '' +
        '<div class="mb-3">' +
        '<label class="form-label fw-semibold text-muted">Funcionário</label>' +
        '<p class="mb-0 fw-bold">' + empName + '</p>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label fw-semibold text-muted">Período</label>' +
        '<p class="mb-0">' + dateStart + ' até ' + dateEnd + '</p>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label class="form-label fw-semibold text-muted">Tipo</label>' +
        '<p class="mb-0"><span class="badge bg-secondary">' + vacType + '</span></p>' +
        '</div>' +
        '<hr>' +
        '<div class="mb-3">' +
        '<label for="approveComment" class="form-label fw-semibold">Comentário (opcional)</label>' +
        '<textarea id="approveComment" class="form-control" rows="2" placeholder="Observação ao aprovar..."></textarea>' +
        '</div>' +
        '<div class="alert alert-info mb-0">' +
        '<i class="fas fa-info-circle me-2"></i>Ao aprovar, a Guia de Férias será gerada e aberta automaticamente para pré-visualização.' +
        '</div>';

      var footerHtml = '' +
        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>' +
        '<button type="button" class="btn btn-success" onclick="submitApprove(' + id + ')">' +
        '<i class="fas fa-check me-1"></i>Confirmar Aprovação' +
        '</button>';

      showModal('success', 'Confirmar Aprovação — Pedido #' + id, bodyHtml, footerHtml);
    }

    function submitApprove(id) {
      var comment = document.getElementById('approveComment') ? document.getElementById('approveComment').value : '';
      document.getElementById('approveCommentInput').value = comment;
      var form = document.getElementById('approveForm');
      form.action = '{{ url("admin/direcao-geral/aprovar-ferias") }}/' + id;
      form.submit();
    }

    /**
     * Rejeitar — usa globalModal existente (sem modal Bootstrap extra)
     */
    function openRejectModal(id, empName) {
      var bodyHtml = '' +
        '<div class="mb-3">' +
        '<label class="form-label fw-semibold text-muted">Funcionário</label>' +
        '<p class="mb-0 fw-bold">' + empName + '</p>' +
        '</div>' +
        '<div class="mb-3">' +
        '<label for="rejectReason" class="form-label fw-semibold">' +
        'Motivo da Rejeição <span class="text-danger">*</span>' +
        '</label>' +
        '<textarea id="rejectReason" class="form-control" rows="3" placeholder="Indique o motivo da recusa (mín. 5 caracteres)..."></textarea>' +
        '<div id="rejectError" class="text-danger small mt-1" style="display:none;">O motivo deve ter pelo menos 5 caracteres.</div>' +
        '</div>' +
        '<div class="alert alert-warning mb-0">' +
        '<i class="fas fa-exclamation-triangle me-2"></i>O pedido será marcado como «Recusado» e o funcionário será notificado.' +
        '</div>';

      var footerHtml = '' +
        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>' +
        '<button type="button" class="btn btn-danger" onclick="submitReject(' + id + ')">' +
        '<i class="fas fa-times me-1"></i>Confirmar Rejeição' +
        '</button>';

      showModal('error', 'Confirmar Rejeição — Pedido #' + id, bodyHtml, footerHtml);
    }

    function submitReject(id) {
      var reason = document.getElementById('rejectReason') ? document.getElementById('rejectReason').value : '';
      if (!reason || reason.trim().length < 5) {
        document.getElementById('rejectError').style.display = 'block';
        document.getElementById('rejectReason').classList.add('is-invalid');
        return;
      }
      document.getElementById('rejectReasonInput').value = reason;
      var form = document.getElementById('rejectForm');
      form.action = '{{ url("admin/direcao-geral/rejeitar-ferias") }}/' + id;
      form.submit();
    }
  </script>
@endsection