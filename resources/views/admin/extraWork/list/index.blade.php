@extends('layouts.merge.admin')
@section('title', 'Trabalhos Extras')
@section('content')
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
                    <a href="{{ route('admin.extras.pdfAll') }}" class="btn btn-outline-secondary">
                        <i class="feather-file me-2"></i>
                        <span>Baixar PDF</span>
                    </a>
                    <a href="{{ route('admin.extras.create') }}" class="btn btn-outline-secondary">
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
                                        <th>Título</th>
                                        <th>Valor Total</th>
                                        <th>Participantes</th>
                                        <th>Status</th>
                                        <th style="width: 58px;">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jobs as $job)
                                        <tr>
                                            <td>{{ $job->title }}</td>
                                            <td>{{ number_format($job->totalValue, 2, ',', '.') }}</td>
                                            <td>{{ $job->employees->count() }}</td>
                                            <td>
                                                <span class="badge bg-{{ $job->statusBadgeColor }}">
                                                    {{ $job->statusInPortuguese }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                        data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                        <i class="feather feather-more-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('admin.extras.show', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-eye"></i> Detalhes
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.extras.edit', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-pencil"></i>Editar
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.extras.pdfShow', $job->id) }}"
                                                                class="dropdown-item" title="baixar pdf dos participantes"
                                                                target="_blank">
                                                                <i class="fas fa-box"></i>pdf
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('admin.extras.destroy', $item->id) }}"
                                                                class="dropdown-item">
                                                                <i class="fas fa-trash"></i>Deletar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <a href="{{ route('admin.extras.pdfShow', $job->id) }}"
                                                    class="btn btn-secondary btn-sm" title="baixar pdf dos participantes"
                                                    target="_blank" rel="noopener noreferrer">PDF</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endsection
