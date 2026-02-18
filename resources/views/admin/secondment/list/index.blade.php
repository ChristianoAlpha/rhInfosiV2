@extends('layouts.merge.admin')
@section('title', 'Lista de Destacamentos')
@section('content')

    {{-- <div class="card mt-4 shadow">
  <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
    <span><i class="fas fa-id-badge me-2"></i>Lista de Destacamentos</span>
    <div>
      <a href="{{ route('secondment.pdfAll') }}" class="btn btn-outline-light btn-sm" title="Baixar PDF" target="_blank" rel="noopener noreferrer">
        <i class="fas fa-file-pdf"></i> Baixar PDF
      </a>
      <a href="{{ route('secondment.create') }}" class="btn btn-outline-light btn-sm" title="Novo Destacamento">
        <i class="fas fa-plus-circle"></i> Novo Destacamento
      </a>
    </div>
  </div>
  <div class="card-body"> --}}
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Destacamentos</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Todos os Destacamentos</li>
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
                    <a href="{{ route('admin.secondments.pdfAll') }}" class="btn btn-outline-secondary" title="Baixar PDF"
                        target="_blank" rel="noopener noreferrer">
                        <i class="fas fa-file-pdf"></i> Baixar PDF
                    </a>
                    <a href="{{ route('admin.secondments.create') }}" class="btn btn-outline-secondary">
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
                                        <th>Causa da Transferência</th>
                                        <th>Instituição</th>
                                        <th>Documento de Suporte</th>
                                        <th>Data de Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $s)
                                        <tr>
                                            <td>{{ $s->id }}</td>
                                            <td>{{ $s->employee->fullName ?? '-' }}</td>
                                            <td>{{ $s->causeOfTransfer ?? '-' }}</td>
                                            <td>{{ $s->institution ?? '-' }}</td>
                                            <td>
                                                @if ($s->supportDocument)
                                                    <a href="{{ asset('uploads/secondments/' . $s->supportDocument) }}"
                                                        target="_blank">
                                                        {{ $s->originalFileName ?? $s->supportDocument }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $s->created_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Nenhum destacamento registrado.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            @endsection
