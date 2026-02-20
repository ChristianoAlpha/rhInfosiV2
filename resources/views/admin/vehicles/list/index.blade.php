@extends('layouts.merge.admin')
@section('title', 'Veículos')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Veículos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todos os Veículos</li>
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
                    <a href="{{ route('admin.vehicles.pdfAll', request()->only('startDate', 'endDate')) }}" class="btn btn-outline-secondary">
                        <i class="feather-file me-2"></i>
                        <span>Baixar PDF</span>
                    </a>
                    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-outline-secondary">
                        <i class="feather-plus me-2"></i>
                        <span>Novo</span>
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
                            <form method="GET" action="{{ route('admin.vehicles.index') }}" class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="date" name="startDate" class="form-control"
                                            value="{{ request('startDate') }}">
                                        <label class="form-label">Data Início</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <input type="date" name="endDate" class="form-control"
                                            value="{{ request('endDate') }}">
                                        <label class="form-label">Data Fim</label>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button class="btn btn-outline-secondary w-100"><i class="fas fa-filter"></i> Filtrar</button>
                                </div>
                            </form>
                            <table id="leadList" class="table table-hover">
                                <table id="datatablesSimple" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Matrícula</th>
                                            <th>Modelo</th>
                                            <th>Status</th>
                                            <th>Quilometragem Atual</th>
                                            <th>Próxima Manut.</th>
                                            {{-- <th>Motorista</th> --}}
                                            <th style="width: 58px">Acções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vehicles as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->plate }}</td>
                                                <td>{{ $item->model }}</td>
                                                <td>{{ $item->status == 'Available' ? 'Disponível' : ($item->status == 'UnderMaintenance' ? 'Em manutenção' : 'Indisponível') }}
                                                </td>
                                                <td>{{ number_format($item->currentMileage ?? 0, 0, ',', '.') }} km</td>
                                                <td>{{ $item->nextMaintenanceDate ? \Carbon\Carbon::parse($v->nextMaintenanceDate)->format('d/m/Y') : '-' }}
                                                </td>
                                                <td>
                                                    {{-- @forelse ($v->drivers as $d)
                                    {{ $d->fullName }}@if (!$loop->last), @endif
                                @empty
                                    -
                                @endforelse --}}
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Operações
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route('admin.vehicles.show', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-eye"></i> Detalhes
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.vehicles.edit', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-pencil"></i>Editar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.vehicles.destroy', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-trash"></i>Deletar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            @endsection
