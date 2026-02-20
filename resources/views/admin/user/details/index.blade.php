@extends('layouts.merge.admin')
@section('title', 'Detalhes do Administrador')
@section('content')

    {{-- <div class="card mt-4 shadow">
  <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
    <span><i class="fas fa-eye me-2"></i>Detalhes do Administrador: {{ $user->email }}</span>
    <div>
      <a href="{{ route('admin.user.index') }}" class="btn btn-outline-light btn-sm" title="Voltar">
        <i class="fa-solid fa-list"></i>
      </a>
      <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning btn-sm" title="Editar">
        <i class="fas fa-pencil"></i>
      </a>

      <!-- Só mostra o botão de apagar se NÃO for o super-admin (role = admin e sem employeeId) -->
      @if (!($user->role === 'admin' && $user->employeeId === null))
        <a href="#" data-url="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-danger btn-sm delete-btn" title="Apagar">
          <i class="fas fa-trash"></i>
        </a>
      @endif
    </div>
  </div> --}}

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Utilizadores</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Detalhes do Utilizador</li>
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
                    <a href="{{ route('admin.user.index') }}" class="btn btn-outline-secondary">
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
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Papel</th>
                                    <td>
                                        <span class="badge bg-primary">
                                            @switch($user->role)
                                                @case('hr')
                                                    Área Administrativa (RH)
                                                @break

                                                @case('department_head')
                                                    Chefe de Departamento
                                                @break

                                                @default
                                                    {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                            @endswitch
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Data de Criação</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-striped table-bordered mb-3">
                                <tr>
                                    <th>Funcionário Vinculado</th>
                                    <td>
                                        @if ($user->employee)
                                            <strong>{{ $user->employee->fullName }}</strong><br>
                                            <small>Email: {{ $user->employee->email }}</small><br><br>
                                            <img src="{{ $user->employee->photo ? asset('frontend/images/departments/' . $user->employee->photo) : asset('frontend/images/default.png') }}"
                                                alt="{{ $user->employee->fullName }}" class="rounded-circle shadow"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        @else
                                            <em>Nenhum funcionário vinculado</em>
                                        @endif
                                    </td>
                                </tr>

                                @if ($user->role === 'director')
                                    <tr>
                                        <th>Biografia</th>
                                        <td>{{ $user->biography ?? '—' }}</td>
                                    </tr>
                                    <tr>
                                        <th>LinkedIn</th>
                                        <td>
                                            @if ($user->linkedin)
                                                <a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a>
                                            @else
                                                —
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
