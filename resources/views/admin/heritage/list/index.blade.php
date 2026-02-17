@extends('layouts.merge.admin')
@section('title', 'Materiais')

@section('content')
    {{--     <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-tools me-2"></i> Materiais de Infraestrutura</span>
            <div>
                <a href="{{ route('admin.heritages.allPdf') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Baixar Lista
                </a>
                <a href="{{ route('admin.heritages.create') }}" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-plus-circle me-1"></i> Novo Material
                </a>
            </div>
        </div> --}}
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
                    <a href="{{ route('admin.heritages.allPdf') }}" class="btn btn-outline-secondary">
                        <i class="feather-file me-2"></i>
                        <span>Baixar PDF</span>
                    </a>
                    <a href="{{ route('admin.heritages.create') }}" class="btn btn-outline-secondary">
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
                            <table id="leadList" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Fornecedor</th>
                                        {{-- <th>MAC</th> --}}
                                        <th>Modelo</th>
                                        <th>Quantidade</th>
                                        <th>Data de fabríco</th>
                                        <th style="width: 100px;" class="text-center">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($heritages as $item)
                                        <tr>
                                            <td>{{ $item->name ?? '-' }}</td>
                                            <td>{{ $item->heritageType->name ?? '-' }}</td>
                                            <td>{{ $item->supplier->name ?? '-' }}</td>
                                            {{-- <td>{{ $item->macAddress ?? '-' }}</td> --}}
                                            <td>{{ $item->model ?? '-' }}</td>
                                            <td>{{ $item->quantity ?? '-' }}</td>
                                            <td>{{ $item->manufactureDate ?? '-' }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Operações
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.heritages.show', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye"></i> Detalhes
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.heritages.edit', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-pencil"></i>Editar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.heritages.destroy', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-trash"></i>Deletar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Nenhum material cadastrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endsection
