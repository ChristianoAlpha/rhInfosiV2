@extends('layouts.merge.admin')
@section('title', 'Novo Pedido de Licença - Selecionar Funcionário')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Pedidos de Licença</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Pedido de Licença</li>
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
                    <a href="{{ route('admin.leaveRequests.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Curso :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Curso</a>
                        </div>
                        <div class="row">
                            <form action="{{ route('leaveRequest.searchEmployee') }}" method="GET" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <!-- Usamos number para ID, se desejar também texto para nome, pode ser text -->
                                            <input type="number" name="employeeId" id="employeeId" class="form-control"
                                                placeholder="" value="{{ old('employeeId') }}">
                                            <label for="employeeId">ID do Funcionário</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-outline-secondary w-100">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            @isset($employee)
                                <hr>
                                <h5>Dados do Funcionário:</h5>
                                <p><strong>Nome:</strong> {{ $employee->fullName }}</p>
                                <p><strong>Departamento:</strong> {{ $employee->department->title ?? '-' }}</p>

                                <form method="POST" action="{{ route('leaveRequest.store') }}">
                                    @csrf
                                    <input type="hidden" name="employeeId" value="{{ $employee->id }}">
                                    <input type="hidden" name="departmentId" value="{{ $employee->department->id ?? '' }}">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select name="leaveTypeId" id="leaveTypeId" class="form-select" required>
                                                <option value="">-- Selecione o Tipo de Licença --</option>
                                                @foreach ($leaveTypes as $lt)
                                                    <option value="{{ $lt->id }}"
                                                        {{ old('leaveTypeId') == $lt->id ? 'selected' : '' }}>
                                                        {{ $lt->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="leaveTypeId">Tipo de Licença</label>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="date" name="leaveStart" id="leaveStart" class="form-control"
                                                    value="{{ old('leaveStart') }}" required>
                                                <label for="leaveStart">Data de Início</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="date" name="leaveEnd" id="leaveEnd" class="form-control"
                                                    value="{{ old('leaveEnd') }}" required>
                                                <label for="leaveEnd">Data de Término</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-2">
                                        <div class="form-floating">
                                            <textarea name="reason" id="reason" placeholder="" style="height: 100px;" class="form-control">{{ old('reason') }}</textarea>
                                            <label for="reason">Razão</label>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 col-4 mx-auto mt-4">
                                        <button type="submit" class="btn btn-outline-secondary">Salvar Pedido</button>
                                    </div>
                                </form>
                            @endisset
                        </div>
                    </div>

                @endsection
