@extends('layouts.merge.admin')
@section('title', 'Editar Categoria de Funcionário')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Categorias</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Editar Categoria</li>
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
                    <a href="{{ route('admin.employeeCategories.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Editar Categoria :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Editar Categoria</a>
                        </div>
                        <div class="row">
                            <form method="POST"
                                action="{{ route('admin.employeeCategories.update', $employeeCategory->id) }}">
                                @csrf
                                @method('PUT')

                                @include('forms._formEmployeeCategory.index')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
