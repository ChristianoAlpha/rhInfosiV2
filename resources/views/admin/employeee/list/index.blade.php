@extends('layouts.merge.admin')

@section('title', 'Funcionários')

@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Funcionários</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Todos os Funcionários</li>
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

                    <a href="{{ route('admin.employeee.pdfAll') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-filetype-pdf me-3"></i>
                        <span>PDF</span>
                    </a>
                    <a href="{{ route('admin.employeee.filter') }}" class="btn btn-outline-secondary">
                        <i class="feather-filter me-2"></i>
                        <span>Filtrar</span>
                    </a>
                    <a href="{{ route('admin.employeee.create') }}" class="btn btn-outline-secondary">
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
                            {{-- SEARCH --}}
                            {{-- <form method="GET" class="d-flex mb-3" style="max-width:320px">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm rounded-start" placeholder="Pesquisar funcionário">
                                <button class="btn btn-outline-secondary btn-sm rounded-end">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form> --}}
                            <table class="table table-hover" id="leadList">
                                <thead>
                                    <tr>
                                        <th class="wd-30">
                                            <div class="btn-group mb-1">
                                                <div class="custom-control custom-checkbox ms-1">
                                                    <input type="checkbox" class="custom-control-input" id="checkAllLead">
                                                    <label class="custom-control-label" for="checkAllLead"></label>
                                                </div>
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Nome Completo</th>
                                        <th>Departamento</th>
                                        <th>Cargo</th>
                                        <th>Especialidade</th>
                                        {{-- <th>Tipo</th> --}}
                                        <th>Categoria</th>
                                        {{-- <th>Nível Acadêmico</th> --}}
                                        {{-- <th>Curso</th> --}}
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>
                                                <div class="item-checkbox ms-1">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox"
                                                            id="checkBox_1">
                                                        <label class="custom-control-label" for="checkBox_1"></label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->fullName }}</td>
                                            <td>{{ $item->department->title ?? '-' }}</td>
                                            <td>{{ $item->position->name ?? '-' }}</td>
                                            <td>{{ $item->specialty->name ?? '-' }}</td>
                                            {{-- <td>{{ $item->employeeType->name ?? '-' }}</td> --}}
                                            <td>{{ $item->employeeCategory->name ?? '-' }}</td>
                                            {{-- <td>{{ $item->academicLevel ?? '-' }}</td> --}}
                                            {{-- <td>{{ $item->course->name ?? '-' }}</td> --}}
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.employeee.show', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye"></i> Detalhes
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.employeee.edit', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-pencil"></i>Editar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.employeee.destroy', $item->id) }}"
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
                                            <td colspan="10" class="text-center">Nenhum funcionário encontrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
