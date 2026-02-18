@extends('layouts.merge.admin')
@section('title', 'Lista de Mobilidades')
@section('content')

    {{-- <div class="card mt-4 mt-4 shadow">
  <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
    <span><i class="fas fa-arrow-left-right me-2"></i>Lista de Mobilidades</span>
    <div>
      <a href="{{ route('admin.mobilities.pdfAll') }}" class="btn btn-outline-light btn-sm" title="Baixar PDF" target="_blank" rel="noopener noreferrer">
        <i class="fas fa-file-pdf"></i> Baixar PDF
      </a>
      <a href="{{ route('admin.mobilities.create') }}" class="btn btn-outline-light btn-sm" title="Nova Mobilidade">
        <i class="fas fa-plus-circle"></i> Nova Mobilidade
      </a>
    </div>
  </div> --}}
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Mobilidades</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todas as Mobilidades</li>
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
                    <a href="{{ route('admin.mobilities.pdfAll') }}" class="btn btn-outline-secondary" title="Baixar PDF"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-file-pdf"></i> Baixar PDF
                    </a>
                    <a href="{{ route('admin.mobilities.create') }}" class="btn btn-outline-secondary">
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
                                        <th>Departamento Antigo</th>
                                        <th>Novo Departamento</th>
                                        <th>Causa</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->employee->fullName ?? '-' }}</td>
                                            <td>{{ $item->oldDepartment->title ?? '-' }}</td>
                                            <td>{{ $item->newDepartment->title ?? '-' }}</td>
                                            <td>{{ $item->causeOfMobility ?? '-' }}</td>
                                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Nenhuma mobilidade registrada.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endsection
