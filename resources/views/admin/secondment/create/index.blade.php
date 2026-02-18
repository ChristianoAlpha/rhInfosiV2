@extends('layouts.merge.admin')
@section('title', 'Novo Destacamento')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Destacamentos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Destacamento</li>
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
                    <a href="{{ route('admin.secondments.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Destacamento :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Destacamento</a>
                        </div>
                        <div class="row">

                            <!-- Formulário para buscar funcionário por ID ou Nome -->
                            <form action="{{ route('admin.secondments.searchEmployee') }}" method="GET" class="mb-4">
                                <div class="row g-3">
                                    <div class="col-md-8">
                                        <div class="form-floating">
                                            <input type="text" name="employeeSearch" id="employeeSearch"
                                                class="form-control" placeholder="" value="{{ old('employeeSearch') }}">
                                            <label for="employeeSearch">Nome do Funcionário</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-outline-secondary w-100 mt-0">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            @isset($employee)
                                <hr>
                                <form action="{{ route('admin.secondments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- ID do Funcionário-->
                                    <input type="hidden" name="employeeId" value="{{ $employee->id }}">

                                    <div class="container">
                                        <!-- Linha 1: Informações do Funcionário -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input type="text" placeholder="" class="form-control"
                                                            value="{{ $employee->fullName }}" readonly>
                                                        <label for="text">Nome do Funcionário</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input type="text" placeholder="" class="form-control"
                                                            value="{{ $employee->department->title ?? '-' }}" readonly>
                                                        <label for="text">Departamento</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Linha 2: Instituição e Documento de Suporte -->
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" name="institution" id="institution"
                                                        class="form-control" placeholder="" value="{{ old('institution') }}"
                                                        required>
                                                    <label for="institution">Instituição</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input type="file" name="supportDocument" class="form-control"
                                                            accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                        <label class="form-label">Documento de Suporte</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Linha 3: Causa da Transferência -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <div class="form-floating">
                                                            <textarea name="causeOfTransfer" placeholder="" style="height: 100px;" class="form-control">{{ old('causeOfTransfer') }}</textarea>
                                                            <label for="causeOfTransfer">Causa da Transferência</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="d-grid gap-2 col-4 mx-auto mt-4">
                                                    <button type="submit" class="btn btn-outline-secondary"><i
                                                            class="fas fa-check-circle"></i> Salvar Destacamento</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            @endisset

                        </div>
                    </div>

                @endsection
