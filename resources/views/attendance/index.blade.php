@extends('layouts.merge.admin')
@section('title', 'Registros de Presença')
@section('content')
    {{-- <div class="card mt-4 shadow" style="margin-top: 1.5rem">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-list me-2"></i>Registros de Presença</span>
            <div>
                <a href="{{ route('attendance.dashboard') }}" class="btn btn-outline-light btn-sm me-2"
                    title="Mapa de Efetividade">
                    <i class="fas fa-chart-bar"></i> Efetividade
                </a>
                <a href="{{ route('attendance.createBatch') }}" class="btn btn-outline-light btn-sm me-2"
                    title="Registro em Lote">
                    <i class="fa-solid fa-comments"></i> Marcação Coletiva
                </a>
                <a href="{{ route('attendance.pdfAll') }}" class="btn btn-outline-light btn-sm me-2" title="Baixar PDF"
                    target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-file-pdf"></i> Baixar PDF
                </a>
                <a href="{{ route('attendance.create') }}" class="btn btn-outline-light btn-sm" title="Novo Registro">
                    <i class="fas fa-plus-circle"></i> Novo Registro
                </a>
            </div>
        </div>
        <div class="card-body"> --}}


    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Cursos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todos os Cursos</li>
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
                    <a href="{{ route('attendance.dashboard') }}" class="btn btn-outline-secondary"
                        title="Mapa de Efetividade">
                        <i class="fas fa-chart-bar"></i> Efetividade
                    </a>
                    <a href="{{ route('attendance.createBatch') }}" class="btn btn-outline-secondary"
                        title="Registro em Lote">
                        <i class="fa-solid fa-comments"></i> Marcação Coletiva
                    </a>
                    <a href="{{ route('attendance.pdfAll') }}" class="btn btn-outline-secondary" title="Baixar PDF"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-file-pdf"></i> Baixar PDF
                    </a>
                    <a href="{{ route('attendance.create') }}" class="btn btn-outline-secondary" title="Novo Registro">
                        <i class="fas fa-plus-circle"></i> Novo Registro
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
                            <form method="GET" class="d-flex mb-3" style="max-width:320px">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm rounded-start" placeholder="Pesquisar funcionário">
                                <button class="btn btn-outline-primary btn-sm rounded-end">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                            <table id="leadList" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Funcionário</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Observações</th>
                                        <th>Criado em</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{ $record->id }}</td>
                                            <td>{{ $record->employee->fullName ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($record->recordDate)->format('d/m/Y') }}</td>
                                            <td>{{ $record->status }}</td>
                                            <td>{{ $record->observations ?? '-' }}</td>
                                            <td>{{ $record->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            @endsection
