@extends('layouts.merge.admin')
@section('title', 'Novo Pedido de Licença')
@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Atribuição de Recursos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Atribuir novo Recurso</li>
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
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Atribuição de Recursos :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Recurso</a>
                        </div>
                        <div class="row">
                            @if (!isset($employee))
                                <!-- Formulário de busca -->
                                <form action="{{ route('admin.resourceAssignments.create') }}" method="GET"
                                    class="mb-3">
                                    <div class="row g-2">
                                        <div class="col-8">
                                            <div class="form-floating">
                                                <input type="text" name="employeeSearch" id="employeeSearch"
                                                    class="form-control" placeholder="" value="{{ old('employeeSearch') }}">
                                                <label for="employeeSearch">Nome do Funcionário</label>
                                            </div>
                                            @error('employeeSearch')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-4">
                                            <button type="submit" class="btn btn-outline-secondary w-100">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <hr>
                                <!-- Dados do Funcionário -->
                                <div class="mb-3">
                                    <h5 class="mb-1">Dados do Funcionário</h5>
                                    <p class="mb-0"><strong>Nome:</strong> {{ $employee->fullName }}</p>
                                    <p class="mb-0"><strong>Departamento:</strong>
                                        {{ $employee->department->title ?? ' -' }}</p>
                                </div>
                                <!-- Formulário de Pedido de Licença -->
                                <form method="POST" action="{{ route('admin.resourceAssignments.store') }}">
                                    @csrf
                                    <input type="hidden" name="employeeeId" value="{{ $employee->id }}">

                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select name="vehicleId" id="vehicleId" class="form-select select2" required>
                                                <option value="">-- Selecione o Veículo --</option>
                                                @foreach ($vehicles as $vehicle)
                                                    <option value="{{ $vehicle->id }}"
                                                        {{ old('vehicleId') == $vehicle->id ? 'selected' : '' }}>
                                                        {{ $vehicle->brand }} - {{ $vehicle->model }} -
                                                        {{ $vehicle->plate }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="vehicleId">Tipo de Veículo</label>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="date" name="start_date" id="start_date" class="form-control"
                                                    value="{{ old('start_date') }}" required>
                                                <label for="start_date">Data de Início</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-floating">
                                                <input type="date" name="end_date" id="end_date" class="form-control"
                                                    value="{{ old('end_date') }}" required>
                                                <label for="end_date">Data de Término</label>
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
