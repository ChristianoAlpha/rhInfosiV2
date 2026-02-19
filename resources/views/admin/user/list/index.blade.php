@extends('layouts.merge.admin')
@section('title', 'Administradores')
@section('content')
    {{-- <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <span><i class="fas fa-person-lines-fill me-2"></i>Lista de Administradores</span>
            <a href="{{ route('admin.user.create') }}" class="btn btn-outline-light btn-sm" title="Adicionar Novo">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
        <div class="card-body">
            <!-- Formulário de pesquisa -->
            <form method="GET" action="{{ route('admin.user.index') }}" class="mb-3">
                <div class="input-group" style="max-width: 400px;">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nome do funcionário"
                        value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </form> --}}

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Utilizadores</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todos os Utilizadores</li>
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
                    <a href="{{ route('admin.user.create') }}" class="btn btn-outline-secondary" title="Adicionar Novo">
                        <i class="fas fa-plus-circle me-2"></i> Adicionar Utilizador
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
                            <form method="GET" action="{{ route('admin.user.index') }}" class="mb-3">
                                <div class="input-group" style="max-width: 400px;">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Buscar por nome do funcionário" value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fas fa-search"></i> Buscar
                                    </button>
                                </div>
                            </form>
                            <table id="leadList" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Funcionário Vinculado</th>
                                        <th>Papel</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->employee->fullName ?? 'Não vinculado' }}</td>
                                            <td>
                                                @switch($item->role)
                                                    @case('admin')
                                                        Administrador
                                                    @break

                                                    @case('rh')
                                                        Chefe de Recursos Humanos
                                                    @break

                                                    @case('employee')
                                                        Funcionário
                                                    @break

                                                    @default
                                                        {{ ucfirst($item->role) }}
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Operações
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.user.show', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye"></i> Detalhes
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.user.edit', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-pencil"></i>Editar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            {{-- <a href="{{ route('admin.user.destroy', $item->id) }}"
                                                    class="dropdown-item">
                                                    <i class="fas fa-trash"></i>Deletar
                                                </a> --}}
                                                            <form action="{{ route('admin.user.destroy', $item->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class=" dropdown-item" title="Apagar"
                                                                    onclick="return confirm('Tem certeza?')">
                                                                    <i class="fas fa-trash"></i>Deletar
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @if ($item->role == 'employee')
                                                    <a href="{{ route('admin.user.contract', $item->id) }}" type="submit"
                                                        class="btn btn-outline-secondary btn-sm" style="width: 40px"
                                                        title="Gerar Contrato">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endsection
