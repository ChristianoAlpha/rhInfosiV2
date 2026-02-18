@extends('layouts.merge.admin')
@section('title', 'Mapa de Férias por Departamento')
@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Pedidos de Férias</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Férias por Departamentos</li>
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
                    <a href="{{ route('admin.vacationRequests.index') }}" class="btn btn-outline-secondary">
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
                            <table id="leadList" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Departamento</th>
                                    <th>Total de Pedidos</th>
                                    <th>Aprovados</th>
                                    <th>Pendentes</th>
                                    <th>Recusados</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($summaryData as $data)
                                        <tr>
                                            <td>{{ $data['department'] }}</td>
                                            <td>{{ $data['total'] }}</td>
                                            <td>{{ $data['approved'] }}</td>
                                            <td>{{ $data['pending'] }}</td>
                                            <td>{{ $data['rejected'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
