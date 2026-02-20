@extends('layouts.merge.admin')
@section('title', 'Registro de Presença - Lote')
@section('content')
    {{-- <div class="card mt-4 shadow">
  <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Registro de Presença - Data: {{ \Carbon\Carbon::parse($recordDate)->format('d/m/Y') }}</h4>
    <a href="{{ route('attendance.index') }}" class="btn btn-outline-light btn-sm" title="Voltar">
      <i class="fas fa-arrow-left"></i> Voltar
    </a>
  </div>
  <div class="card-body"> --}}
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Mapa de Efetividade</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Registro de Presença - Lote</li>
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
                    <a href="{{ route('attendance.index') }}" class="btn btn-outline-secondary">
                        <i class="feather-list me-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->
    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card stretch stretch-full">
                    <div class="card-body lead-status">
                        <div class="mb-5 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 me-4">
                                <span class="d-block mb-2">Registro de Presença - Lote :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Curso</a>
                        </div>
                        <div class="row">
                            <form method="POST" action="{{ route('attendance.storeBatch') }}">
                                @csrf
                                <input type="hidden" name="recordDate" value="{{ $recordDate }}">

                                <h5>Funcionários Ativos</h5>
                                @if (count($activeEmployees))
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Funcionário</th>
                                                    <th>Status</th>
                                                    <th>Observações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($activeEmployees as $employee)
                                                    <tr>
                                                        <td>{{ $employee->fullName }}</td>
                                                        <td>
                                                            <select name="attendance[{{ $employee->id }}]"
                                                                class="form-select" required>
                                                                <option value="">-- Selecione --</option>
                                                                <option value="Presente">Presente</option>
                                                                <option value="Ausente">Ausente</option>
                                                                <option value="Férias">Férias</option>
                                                                <option value="Licença">Licença</option>
                                                                <option value="Doença">Doença</option>
                                                                <option value="Teletrabalho">Teletrabalho</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="observations[{{ $employee->id }}]"
                                                                class="form-control" placeholder="Observações">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>Nenhum funcionário ativo para registro.</p>
                                @endif

                                <hr>
                                <h5>Funcionários com Ausência Justificada</h5>
                                @if (count($justifiedEmployees))
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Funcionário</th>
                                                    <th>Justificativa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($justifiedEmployees as $item)
                                                    <tr>
                                                        <td>{{ $item['employee']->fullName }}</td>
                                                        <td>{{ $item['justification'] }} ({{ $item['details'] }})</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>Nenhum funcionário com ausência justificada.</p>
                                @endif

                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-outline-secondary" style="width: auto;">
                                        <i class="fas fa-check-circle"></i> Salvar Registros
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endsection
