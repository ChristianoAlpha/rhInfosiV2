@extends('layouts.merge.admin')
@section('title', 'Adicionar Pagamento de Salário')
@section('content')
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Pagamentos de Salário</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">Adicionar novo Pagamento de Salário</li>
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
                    <a href="{{ route('admin.salaryPayments.index') }}" class="btn btn-outline-secondary">
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
                                <span class="d-block mb-2">Adicionar Novo Pagamento de Salário :</span>
                                <span class="fs-12 fw-normal text-muted text-truncate-1-line">Preencher todos os campos
                                    do formulário é obrigatório</span>
                            </h5>
                            <a href="javascript:void(0);" class="btn btn-sm btn-light-brand">Adicionar Pagamento</a>
                        </div>
                        <div class="row">
                            <form id="salaryForm" method="POST" action="{{ route('admin.salaryPayments.store') }}">
                                @csrf

                                @include('forms._formSalaryPayment.index')
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @push('scripts')
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const searchInput = document.getElementById('employeeSearch');
                        const list = document.getElementById('employeeList');
                        const hiddenId = document.getElementById('employeeId');

                        // === BUSCA DE FUNCIONÁRIO (igual antes) ===
                        searchInput.addEventListener('input', async () => {
                            const query = searchInput.value.trim();
                            list.innerHTML = '';
                            list.style.display = 'none';
                            if (query.length < 2) return;

                            try {
                                const res = await fetch(
                                    `{{ route('admin.salaryPayments.searchEmployeeAjax') }}?q=${encodeURIComponent(query)}`
                                    );
                                const employees = await res.json();

                                if (employees.length === 0) {
                                    list.innerHTML =
                                        '<div class="list-group-item text-muted">Nenhum funcionário encontrado</div>';
                                    list.style.display = 'block';
                                    return;
                                }

                                employees.forEach(emp => {
                                    const item = document.createElement('a');
                                    item.href = '#';
                                    item.className = 'list-group-item list-group-item-action';
                                    item.innerHTML =
                                        `<strong>${emp.text}</strong><br><small class="text-muted">${emp.extra}</small>`;
                                    item.onclick = e => {
                                        e.preventDefault();
                                        selectEmployee(emp);
                                    };
                                    list.appendChild(item);
                                });
                                list.style.display = 'block';
                            } catch (err) {
                                console.error(err);
                            }
                        });

                        function selectEmployee(emp) {
                            hiddenId.value = emp.id;
                            document.getElementById('empName').textContent = emp.text;
                            document.getElementById('empDept').textContent = emp.extra.replace('Depto: ', '');
                            document.getElementById('empEmail').textContent = emp.email || '-';
                            document.getElementById('empIban').textContent = emp.iban || '-';
                            document.getElementById('employeeInfo').classList.remove('d-none');
                            searchInput.value = emp.text;
                            list.style.display = 'none';
                            updateDiscount();
                        }

                        document.addEventListener('click', e => {
                            if (!searchInput.contains(e.target) && !list.contains(e.target)) {
                                list.style.display = 'none';
                            }
                        });

                        // === MÁSCARA DE MOEDA ===
                        $('.currency').mask('#.##0,00', {
                            reverse: true
                        });

                        function formatMoney(value) {
                            return Number(value).toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                        }

                        function updateDiscount() {
                            if (!hiddenId.value) return;

                            const base = parseFloat($('#baseSalary').val().replace(/\./g, '').replace(',', '.')) || 0;
                            const subs = parseFloat($('#subsidies').val().replace(/\./g, '').replace(',', '.')) || 0;
                            const month = $('#workMonth').val();

                            fetch(
                                    `{{ route('admin.salaryPayments.calculateDiscount') }}?employeeId=${hiddenId.value}&baseSalary=${base}&subsidies=${subs}&workMonth=${month}`)
                                .then(r => r.json())
                                .then(j => {
                                    $('#discount').val(formatMoney(j.discount));
                                    $('#absentInfo').text(
                                        `Faltas injustificadas em ${month.replace('-', '/')} : ${j.absentDays} dia(s)`);
                                });
                        }

                        $('#baseSalary, #subsidies, #workMonth').on('keyup change', updateDiscount);

                        // AQUI ESTÁ A MÁGICA — ANTES DE ENVIAR, LIMPA TUDO!
                        document.getElementById('salaryForm').addEventListener('submit', function(e) {
                            // Remove máscara e converte para número limpo (ex: 12.345,67 → 12345.67)
                            $('.currency').each(function() {
                                let val = this.value;
                                val = val.replace(/\./g, ''); // remove pontos
                                val = val.replace(/,/g, '.'); // vírgula vira ponto
                                this.value = parseFloat(val) || 0; // deixa só o número
                            });
                        });
                    });
                </script>
            @endpush
        @endsection
