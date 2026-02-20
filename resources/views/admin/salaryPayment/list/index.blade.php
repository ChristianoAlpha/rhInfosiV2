@extends('layouts.merge.admin')
@section('title', 'Pagamentos de Salário')
@section('content')

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
                    <a href="{{ route('admin.salaryPayments.pdfAll') }}" class="btn btn-outline-secondary "
                        style="width:110px;" target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-file-pdf"></i> Todos
                    </a>

                    <button class="btn btn-outline-secondary " style="width:110px;" type="button"
                        data-bs-toggle="collapse" data-bs-target="#filterArea">
                        <i class="fas fa-calendar-alt"></i> Filtrar
                    </button>
                    <a href="{{ route('admin.salaryPayments.create') }}" class="btn btn-outline-secondary">
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

                        {{-- <div
                                    class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-money-bill-wave me-2"></i>Pagamentos de Salário</span>

                                    <div class="d-flex gap-2">


                                        <a href="{{ route('admin.salaryPayments.pdfAll') }}"
                                            class="btn btn-outline-light btn-sm" style="width:110px;" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fas fa-file-pdf"></i> Todos
                                        </a>

                                        <button class="btn btn-outline-light btn-sm" style="width:110px;" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#filterArea">
                                            <i class="fas fa-calendar-alt"></i> Filtrar
                                        </button>




                                        <a href="{{ route('admin.salaryPayments.create') }}"
                                            class="btn btn-outline-light btn-sm" style="width:110px;"
                                            title="Novo Pagamento">
                                            <i class="fas fa-plus-circle"></i> Novo
                                        </a>

                                    </div>
                                </div> --}}


                        <div class="collapse" id="filterArea">
                            <div class="card-body border-bottom">

                                <form class="row g-3" method="GET" action="{{ route('admin.salaryPayments.index') }}">

                                    <div class="col-md-3">
                                        <input type="date" name="startDate" value="{{ $filters['startDate'] ?? '' }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <input type="date" name="endDate" value="{{ $filters['endDate'] ?? '' }}"
                                            class="form-control">
                                    </div>


                                    <div class="col-md-2">
                                        <button class="btn btn-primary w-100">Aplicar Filtro</button>
                                    </div>


                                    <div class="col-md-2">
                                        <a href="{{ route('admin.salaryPayments.index') }}" class="btn btn-secondary w-100">
                                            Limpar Filtro Aplicado
                                        </a>
                                    </div>


                                    <div class="col-md-2">
                                        <a href="{{ route('admin.salaryPayments.pdfPeriod', [
                                            'startDate' => $filters['startDate'] ?? '',
                                            'endDate' => $filters['endDate'] ?? '',
                                        ]) }}"
                                            type="submit" class="btn btn-outline-secondary w-100" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="fas fa-file-pdf"></i> Baixar Intervalo
                                        </a>
                                    </div>




                                </form>

                            </div>
                        </div>


                        <div class="card-body">

                            <form method="GET" class="d-flex mb-3" style="max-width:320px">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm rounded-start" placeholder="Pesquisar funcionário">
                                <button class="btn btn-outline-primary btn-sm rounded-end">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>



                            <div class="table-responsive">
                                <table id="leadList" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Competência</th>
                                            <th>Funcionário</th>
                                            <th>Departamento</th>
                                            <th>Tipo</th>
                                            <th>IBAN</th>
                                            <th>Sal. Básico</th>
                                            <th>Subsídios</th>
                                            <th>Desconto</th>
                                            <th>Sal. Líquido</th>
                                            <th>Pagamento</th>
                                            <th>Status</th>
                                            <th style="width: 58px">Ações</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($salaryPayments as $p)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($p->workMonth)->translatedFormat('F/Y') }}
                                                </td>
                                                <td>{{ $p->employee->fullName }}</td>
                                                <td>{{ $p->employee->department->title ?? '-' }}</td>
                                                <td>{{ $p->employee->employeeType->name ?? '-' }}</td>
                                                <td>{{ $p->employee->iban }}</td>
                                                <td>{{ number_format($p->baseSalary, 2, ',', '.') }}</td>
                                                <td>{{ number_format($p->subsidies, 2, ',', '.') }}</td>
                                                <td>{{ number_format($p->discount, 2, ',', '.') }}</td>

                                                <td><strong>{{ number_format($p->salaryAmount, 2, ',', '.') }}</strong>
                                                </td>

                                                <td>{{ $p->paymentDate }}</td>
                                                <td>{{ $p->paymentStatus }}</td>

                                                {{-- AÇÕES — ADICIONADO ÍCONE NO PDF (QUE FALTAVA) --}}
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('admin.salaryPayments.show', $p->id) }}"
                                                        class="btn btn-sm btn-warning" title="Ver Detalhes">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.salaryPayments.edit', $p->id) }}"
                                                        class="btn btn-sm btn-info" title="Editar Registro">
                                                        <i class="fas fa-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('admin.salaryPayments.pdfByEmployee', [
                                                        'employeeId' => $p->employee->id,
                                                        'year' => now()->year,
                                                    ]) }}"
                                                        class="btn btn-sm btn-secondary" title="PDF Anual" target="_blank">
                                                        <i class="fas fa-file-pdf"></i>
                                                    </a>

                                                    <form action="{{ route('admin.salaryPayments.destroy', $p->id) }}"
                                                        method="POST" style="display:inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" title="Apagar">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                @endsection
