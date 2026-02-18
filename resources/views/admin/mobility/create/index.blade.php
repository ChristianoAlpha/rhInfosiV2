@extends('layouts.merge.admin')
@section('title', 'Nova Mobilidade')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Mobilidades</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar nova Mobilidade</li>
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
                    <a href="{{ route('admin.mobilities.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Pesquisar Funcionário :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Mobilidade</a>
                        </div>
                        <div class="row">

                            <!-- Formulário para buscar o funcionário por ID ou Nome -->
                            @if (!isset($employee))
                                <form action="{{ route('admin.mobilities.searchEmployee') }}" method="GET" class="mb-4">
                                    <div class="row g-3">
                                        <div class="col-md-8">
                                            <div class="form-floating">
                                                <input type="text" name="employeeSearch" id="employeeSearch"
                                                    class="form-control" placeholder="" value="{{ old('employeeSearch') }}">
                                                <label for="employeeSearch">Nome do Funcionário</label>
                                            </div>
                                            @error('employeeSearch')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-outline-secondary w-100">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <hr>
                                <!-- Dados do Funcionário -->
                                <div class="mb-3">
                                    <h5>Dados do Funcionário</h5>
                                    <p><strong>Nome:</strong> {{ $employee->fullName }}</p>
                                    <p><strong>E-mail:</strong> {{ $employee->email }}</p>
                                    <p><strong>Departamento Atual:</strong> {{ $oldDepartment->title ?? '-' }}</p>
                                </div>
                                <!-- Formulário de Mobilidade -->
                                <form action="{{ route('admin.mobilities.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="employeeId" value="{{ $employee->id }}">
                                    <input type="hidden" name="oldDepartmentId" value="{{ $oldDepartment->id ?? '' }}">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <select name="newDepartmentId" id="newDepartmentId" class="form-select"
                                                required>
                                                <option value="">-- Selecione --</option>
                                                @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}"
                                                        @if (old('newDepartmentId') == $dept->id) selected @endif>
                                                        {{ $dept->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="newDepartmentId" class="form-label">Novo Departamento</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea name="causeOfMobility" placeholder="" id="causeOfMobility" style="height: 100px;" class="form-control">{{ old('causeOfMobility') }}</textarea>
                                            <label for="causeOfMobility">Causa da Mobilidade</label>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2 col-4 mx-auto mt-4">
                                        <button type="submit" class="btn btn-outline-secondary">Salvar Mobilidade</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                @endsection
