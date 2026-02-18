@extends('layouts.merge.admin')
@section('title', 'Novo Trabalho Extra')
@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Trabalhos Extras</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Trabalho Extra</li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i>
                        <span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <a href="{{ route('admin.extras.index') }}" class="btn btn-outline-secondary">
                        <i class="feather-list me-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body lead-status">
                        <div class="mb-5 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 me-4">
                                <span class="d-block mb-2">Adicionar Novo Trabalho Extra :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Trabalho Extra</a>
                        </div>
                        <div class="row">
                            <form method="POST" action="{{ route('admin.extras.store') }}" id="jobForm">
                                @csrf

                                {{-- Compact fields in one row --}}
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="form-floating">
                                            <input type="text" name="title" placeholder="" class="form-control"
                                                value="{{ old('title') }}" required>
                                            <label for="name">Título</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-floating">
                                            <input type="text" name="totalValue" placeholder=""
                                                class="form-control currency" value="{{ old('totalValue') }}" required>
                                            <label for="totalValue">Total (Kz)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-floating">
                                            <select name="status" class="form-control" required>
                                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>
                                                    Pendente</option>
                                                <option value="Approved"
                                                    {{ old('status') == 'Approved' ? 'selected' : '' }}>Aprovado
                                                </option>
                                                <option value="Rejected"
                                                    {{ old('status') == 'Rejected' ? 'selected' : '' }}>Recusado
                                                </option>
                                            </select>
                                            <label for="status">Status</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="form-floating">
                                            <input type="text" id="employeeSearch" class="form-control" placeholder="">
                                            <label for="employeeSearch">Buscar Pelo Nome...</label>
                                            <div id="employeeList" class="list-group mt-1"></div>
                                        </div>
                                    </div>
                                </div>

                                <h5>Participantes Selecionados</h5>
                                <table class="table" id="selectedTable">
                                    <thead>
                                        <tr>
                                            <th>Funcionário</th>
                                            <th>Departamento</th>
                                            <th>Ajus. (Kz)</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <div class="d-grid gap-2 col-3 mx-auto mt-4">
                                    <button type="submit" class="btn btn-outline-secondary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endsection

                @push('scripts')
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const employeeSearch = document.getElementById('employeeSearch'),
                                employeeList = document.getElementById('employeeList'),
                                selectedTable = document.querySelector('#selectedTable tbody');
                            let selectedEmployees = {};

                            const searchUrl = "{{ route('admin.extras.searchEmployee') }}";

                            employeeSearch.addEventListener('input', async () => {
                                const query = employeeSearch.value.trim();
                                employeeList.innerHTML = '';
                                if (!query) return;
                                try {
                                    const response = await fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
                                        headers: {
                                            'Accept': 'application/json'
                                        }
                                    });
                                    if (!response.ok) return;
                                    const data = await response.json();
                                    data.forEach(employee => {
                                        if (selectedEmployees[employee.id]) return;
                                        const item = document.createElement('a');
                                        item.href = '#';
                                        item.className = 'list-group-item list-group-item-action';
                                        item.innerHTML =
                                            `<strong>${employee.text}</strong><br><small>${employee.extra}</small>`;
                                        item.onclick = event => {
                                            event.preventDefault();
                                            addParticipant(employee);
                                        };
                                        employeeList.appendChild(item);
                                    });
                                } catch (error) {
                                    console.error('Falha ao buscar funcionários:', error);
                                }
                            });

                            function addParticipant(employee) {
                                selectedEmployees[employee.id] = true;
                                const tableRow = document.createElement('tr');
                                tableRow.dataset.id = employee.id;
                                tableRow.innerHTML = `
      <td>
        ${employee.text}
        <input type="hidden" name="participants[]" value="${employee.id}">
      </td>
      <td>${employee.extra}</td>
      <td><input type="text" name="bonus[${employee.id}]" class="form-control currency" value="0"></td>
      <td><button type="button" class="btn btn-sm btn-danger remove-participant">Remover</button></td>
    `;
                                tableRow.querySelector('.remove-participant').onclick = () => {
                                    delete selectedEmployees[employee.id];
                                    tableRow.remove();
                                };
                                selectedTable.appendChild(tableRow);
                                employeeList.innerHTML = '';
                                employeeSearch.value = '';
                            }
                        });
                    </script>
                @endpush
