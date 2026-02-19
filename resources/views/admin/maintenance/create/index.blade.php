@extends('layouts.merge.admin')
@section('title', 'Nova Manutenção')
@section('content')
    {{-- start Dependências do Editor de Texto --}}
    <link rel="stylesheet" href="{{ url('ckeditor5/style.css') }}">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.1.1/ckeditor5.css" crossorigin>
    {{-- end Dependências do Editor de Texto --}}

    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Manutenções</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar nova Manutenção</li>
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
                    <a href="{{ route('admin.maintenances.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Manutenção :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Manutenção</a>
                        </div>
                        <div class="row">
                            <form action="{{ route('admin.maintenances.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                @include('forms._formMaintenance.index')
                            </form>
                        </div>
                    </div>

                    <script src="https://cdn.ckeditor.com/ckeditor5/46.1.1/ckeditor5.umd.js" crossorigin></script>
                    @include('extra._ckeditor.index')
                    {{-- <script src="{{ url('ckeditor5/main.js') }}"></script> --}}
                    <script>
                        function loadVehicleDetails(id) {
                            const opt = document.querySelector(`#vehicleId option[value="${id}"]`);
                            if (opt) {
                                document.getElementById('brand').textContent = opt.dataset.brand;
                                document.getElementById('model').textContent = opt.dataset.model;
                                document.getElementById('year').textContent = opt.dataset.year;
                                document.getElementById('plate').textContent = opt.dataset.plate;
                                document.getElementById('vehicleDetails').style.display = 'flex';
                            } else {
                                document.getElementById('vehicleDetails').style.display = 'none';
                            }
                        }

                        function toggleSubtypes(type) {
                            document.getElementById('subtypesSection').style.display = 'block';
                            ['preventive', 'corrective', 'repair'].forEach(id => document.getElementById(id).style.display = 'none');
                            if (type) document.getElementById(type.toLowerCase()).style.display = 'block';
                        }

                        function toggleServiceDetails(service, checked) {
                            const container = document.getElementById('serviceDetails');
                            const existing = document.getElementById(`detail-${service}`);
                            if (checked && !existing) {
                                let html = '';
                                if (service === 'troca_oleo') {
                                    html = `<div class="service-detail-row row g-3 mt-2" id="detail-${service}">
                <div class="col-md-5"><input type="text" name="services[${service}][tipo]" placeholder="Tipo de Óleo" class="form-control"></div>
                <div class="col-md-5"><input type="text" name="services[${service}][quantidade]" placeholder="Quantidade" class="form-control"></div>
                <div class="col-md-2"><button type="button" class="btn btn-sm btn-danger" onclick="removeDetail('${service}')">×</button></div>
            </div>`;
                                } else {
                                    html = `<div class="service-detail-row row g-3 mt-2" id="detail-${service}">
                <div class="col-md-10"><input type="text" name="services[${service}][tipo]" placeholder="Tipo" class="form-control"></div>
                <div class="col-md-2"><button type="button" class="btn btn-sm btn-danger" onclick="removeDetail('${service}')">×</button></div>
            </div>`;
                                }
                                container.insertAdjacentHTML('beforeend', html);
                            } else if (!checked && existing) {
                                existing.remove();
                            }
                        }

                        function removeDetail(service) {
                            const el = document.getElementById(`detail-${service}`);
                            if (el) el.remove();
                            const checkbox = document.querySelector(`input[name="services[${service}]"]`);
                            if (checkbox) checkbox.checked = false;
                        }

                        function toggleOtherServices(checked) {
                            document.getElementById('otherServices').style.display = checked ? 'block' : 'none';
                        }
                    </script>
                @endsection
