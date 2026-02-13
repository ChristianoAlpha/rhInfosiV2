@extends('layouts.merge.admin')
@section('title', 'Departamentos')
@section('content')

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Departamentos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Todos os Departamentos</li>
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
                    <a href="{{ route('admin.departments.create') }}" class="btn btn-outline-secondary">
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
                            <!-- Formulário para selecionar departamento e listar seus funcionários -->
                            <div class="mt-4">
                                <p class="mb-3  text-muted">Listar funcionários por departamento:</p>
                                <form action="{{ route('admin.departments.employeee') }}" method="GET"
                                    class="d-inline-flex">
                                    <div class="input-group w-auto">
                                        <select name="department" class="form-select" required>
                                            <option value=""> Selecione o Departamento </option>
                                            @foreach ($data as $d)
                                                <option value="{{ $d->id }}">{{ $d->title }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-outline-secondary" title="Pesquisar">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <table class="table table-hover" id="leadList">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Descrição</th>
                                        <th style="width: 58px;">Ação</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($data)
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->description ?? '-' }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                            data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                            <i class="feather feather-more-horizontal"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="{{ route('admin.departments.show', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-eye"></i> Detalhes
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.departments.edit', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-pencil"></i>Editar
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('admin.departments.destroy', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i class="fas fa-trash"></i>Deletar
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
