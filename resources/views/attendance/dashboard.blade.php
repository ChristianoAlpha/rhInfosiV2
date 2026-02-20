@extends('layouts.merge.admin')
@section('title', 'Mapa de Efetividade')
@section('content')
    {{-- <div class="card mt-4 shadow">
  <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
    <div>
      <h4>Mapa de Efetividade</h4>
      <p>Período: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} a {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>
    <div>
      <a href="{{ route('attendance.index') }}" class="btn btn-outline-light btn-sm" title="Voltar">
        <i class="fas fa-arrow-left"></i> Voltar
      </a>
    </div>
  </div>
  <div class="card-body"> --}}

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Mapa de Efetividade</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item">Mapa de Efetividade Período:
                    {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} a
                    {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</li>
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
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary" title="Voltar">
                        <i class="fas fa-arrow-left"></i> Voltar
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
                                        <th>Funcionário</th>
                                        <th>Departamento</th>
                                        <th>Total Dias Úteis</th>
                                        <th>Presenças</th>
                                        <th>Dias Justificados</th>
                                        <th>Faltas</th>
                                        <th>Taxa de Presença (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dashboardData as $item)
                                        <tr>
                                            <td>{{ $item['employeeName'] }}</td>
                                            <td>{{ $item['department'] }}</td>
                                            <td>{{ $item['totalWeekdays'] }}</td>
                                            <td>{{ $item['presentDays'] }}</td>
                                            <td>{{ $item['justifiedDays'] }}</td>
                                            <td>{{ $item['absentDays'] }}</td>
                                            <td>{{ $item['attendanceRate'] }}%</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endsection
