@extends('layouts.merge.admin')
@section('title', 'Tipos de Património')

@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Tipos de Património</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todos os Tipos de Património</li>
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
                    <a href="{{ route('admin.heritageTypes.create') }}" class="btn btn-outline-secondary">
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
                                        <th>Descrição</th>
                                        <th style="width: 100px;" class="text-center">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($types as $t)
                                        <tr>
                                            <td>{{ $t->name }}</td>
                                            <td>{{ $t->description ?? '—' }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Operações
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.heritageTypes.show', $t->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye"></i> Detalhes
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.heritageTypes.edit', $t->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-pencil"></i>Editar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.heritageTypes.destroy', $t->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-trash"></i>Deletar
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                            <a href="#" data-url="{{ route('admin.heritageTypes.destroy', $t->id) }}" class="dropdown-item"
                                                 title="Remover"><i
                                                    class="fas fa-trash"></i></a>Deletar
                                        </li> --}}
                                                    </ul>
                                                </div>
                                                {{-- <a href="{{ route('admin.heritageTypes.show', $t->id) }}" class="btn btn-sm btn-info"
                                    title="Ver"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('admin.heritageTypes.edit', $t->id) }}" class="btn btn-sm btn-warning"
                                    title="Editar"><i class="fas fa-pencil"></i></a>
                                <a href="#" data-url="{{ route('admin.heritageTypes.destroy', $t->id) }}"
                                    class="btn btn-sm btn-danger delete-btn" title="Remover"><i class="fas fa-trash"></i></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Nenhum tipo de património cadastrado.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endsection
