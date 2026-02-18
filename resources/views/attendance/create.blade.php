@extends('layouts.merge.admin')
@section('title', 'Registrar Presença')
@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Mapa de Efetividade</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Registro de Presença individual</li>
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
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Registro de Presença :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Registro</a>
                        </div>
                        <div class="row">
                            <form method="POST" action="{{ route('attendance.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select name="employeeId" id="employeeId" class="form-select" required>
                                            <option value="">-- Selecione o Funcionário --</option>
                                            @foreach ($employees as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->fullName }}</option>
                                            @endforeach
                                        </select>
                                        <label for="employeeId" class="form-label">Funcionário</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="date" name="recordDate" id="recordDate" class="form-control"
                                            value="{{ date('Y-m-d') }}" readonly>
                                        <label for="recordDate" class="form-label">Data do Registro</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="">-- Selecione o Status --</option>
                                            <option value="Presente">Presente</option>
                                            <option value="Ausente">Ausente</option>
                                            <option value="Férias">Férias</option>
                                            <option value="Licença">Licença</option>
                                            <option value="Doença">Doença</option>
                                            <option value="Teletrabalho">Teletrabalho</option>
                                        </select>
                                        <label for="status" class="form-label">Status</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea name="observations" id="observations" placeholder="" style="height: 100px;" class="form-control"></textarea>
                                        <label for="observations">Observações</label>
                                    </div>
                                </div>

                                <div id="justificationMessage" class="mb-3"></div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-secondary" style="width: auto;">
                                        <i class="fas fa-check-circle"></i> Registrar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const employeeSelect = document.getElementById('employeeId');
                    const recordDateInput = document.getElementById('recordDate');
                    const statusSelect = document.getElementById('status');
                    const justificationMessage = document.getElementById('justificationMessage');

                    function checkJustification() {
                        const employeeId = employeeSelect.value;
                        const recordDate = recordDateInput.value;
                        if (employeeId && recordDate) {
                            fetch(`{{ route('attendance.checkStatus') }}?employeeId=${employeeId}&recordDate=${recordDate}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.justification) {
                                        justificationMessage.innerHTML =
                                            `<div class="alert alert-info">Este funcionário está com ${data.justification} (${data.details}) para esta data.</div>`;
                                        statusSelect.value = data.justification;
                                        statusSelect.disabled = true;
                                    } else {
                                        justificationMessage.innerHTML = '';
                                        statusSelect.disabled = false;
                                    }
                                })
                                .catch(error => console.error('Erro:', error));
                        }
                    }

                    employeeSelect.addEventListener('change', checkJustification);
                    recordDateInput.addEventListener('change', checkJustification);
                });
            </script>
        @endsection

    @endsection
