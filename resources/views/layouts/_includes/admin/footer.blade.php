<!-- [ Footer ] start -->
<footer class="footer">
    <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
        <span>Copyright © Gestão de Capital Humano INFOSI </span>
        <script>
            document.write(new Date().getFullYear());
        </script>
    </p>
    <div class="d-flex align-items-center gap-4">
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Termos & Condições</a>
        <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Política de Privacidade</a>
    </div>
</footer>
<!-- [ Footer ] end -->
</div>

<!-- Vendors JS -->
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/dataTables.bs5.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2-active.min.js') }}"></script>

<!-- Common JS -->
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/leads-init.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboard-init.min.js') }}"></script>

<!-- Theme Customizer -->
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>

<!-- start Modal Dinâmica Única -->
@include('extra._alerts.index')
<!-- end Modal Dinâmica Única -->

<script>
    //select2
    $('.select2').select2();

    const nationalitySelect = document.getElementById('nationality');
    if (nationalitySelect) {
        fetch('/api/countries').then(res => res.json()).then(data => {
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = `${country.name} (${country.code})`;
                option.textContent = `${country.name} (${country.code})`;
                nationalitySelect.appendChild(option);
            });
        });
    }

    const phoneCodeMenu = document.getElementById('phone_code_menu');
    if (phoneCodeMenu) {
        fetch('/api/countries').then(res => res.json()).then(data => {
            data.forEach(country => {
                if (country.phone) {
                    const li = document.createElement('li');
                    const a = document.createElement('a');
                    a.classList.add('dropdown-item');
                    a.textContent = `${country.name} (+${country.phone})`;
                    a.addEventListener('click', e => {
                        e.preventDefault();
                        document.getElementById('selected_code').textContent = country.phone;
                        document.getElementById('phoneCode').value = country.phone;
                    });
                    li.appendChild(a);
                    phoneCodeMenu.appendChild(li);
                }
            });
        });
    }

</script>
@yield('scripts')
@stack('scripts')

</body>

</html>