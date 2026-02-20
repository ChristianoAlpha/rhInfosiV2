@extends('layouts.merge.admin')
@section('title', 'Criar Tipo de Licença')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Tipos de Licença</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Tipo de Licença</li>
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
                    <a href="{{ route('admin.leaveTypes.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Tipo de Licença :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Tipo de Licença</a>
                        </div>
                        <div class="row">
                            <form method="POST" action="{{ route('admin.leaveTypes.store') }}">
                                @csrf

                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" name="name" placeholder="" class="form-control"
                                            value="{{ old('name') }}" required>
                                        <label for="name">Nome</label>
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <div class="form-floating">
                                        <textarea name="description" placeholder="" style="height: 100px;" class="form-control">{{ old('description') }}</textarea>
                                        <label for="description">Descrição</label>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 col-4 mx-auto mt-4">
                                    <button type="submit" class="btn btn-outline-secondary">Salvar Tipo de Licença</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
