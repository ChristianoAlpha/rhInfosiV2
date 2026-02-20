@extends('layouts.merge.admin')
@section('title', 'Detalhes do Curso')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Cursos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Detalhes do Curso</li>
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
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $course->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nome do Curso</th>
                                        <td>{{ $course->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Criado em</th>
                                        <td>{{ Carbon\Carbon::parse($course->created_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Atualizado em</th>
                                        <td>{{ Carbon\Carbon::parse($course->updated_at)->format('d/m/Y H:i:s') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
