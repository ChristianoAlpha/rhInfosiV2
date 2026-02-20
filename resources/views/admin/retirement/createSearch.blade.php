@extends('layouts.merge.admin')
@section('title', 'Adicionar Pedido de Reforma')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Reformados</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Pedido de Reforma</li>
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
                    <a href="{{ route('admin.retirements.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Pesquisar nome do funcionário:</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Pedido de Reforma</a>
                        </div>
                        <div class="row">
                            <!-- Formulário de busca para selecionar funcionário -->
                            <form action="{{ route('admin.retirements.searchEmployee') }}" method="GET" class="mb-3">
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

                            @isset($employee)
                                <hr>
                                <h5>Dados do Funcionário:</h5>
                                <p><strong>Nome:</strong> {{ $employee->fullName }}</p>
                                <p><strong>E-mail:</strong> {{ $employee->email }}</p>
                                <p><strong>Departamento:</strong> {{ $employee->department->title ?? '-' }}</p>

                                <form method="POST" action="{{ route('admin.retirements.store') }}">
                                    @csrf
                                    <input type="hidden" name="employeeId" value="{{ $employee->id }}">
                                    <div class="mb-3">
                                        <label for="retirementDate" class="form-label">Data de Reforma</label>
                                        <input type="date" name="retirementDate" id="retirementDate" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea name="observations" placeholder="" id="observations" style="height: 100%;" class="form-control"></textarea>
                                            <label for="observations" class="form-label">Observações</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status" id="status" class="form-select">
                                            <option value="Pendente" selected>Pendente</option>
                                            <option value="Aprovado">Aprovado</option>
                                            <option value="Rejeitado">Rejeitado</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-check-circle"></i> Enviar Pedido
                                    </button>
                                </form>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        @endsection
