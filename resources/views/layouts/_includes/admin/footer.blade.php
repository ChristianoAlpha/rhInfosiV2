<footer class="footer bg-secondary text-white mt-auto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                {{-- Copyright © Gestão de Capital Humano INFOSI {{ date('Y') }} --}}
            </div>
            <div class="col-md-4 text-center">
                <a href="#" class="text-white text-decoration-none">Política de Privacidade</a> ·
                <a href="#" class="text-white text-decoration-none">Termos & Condições</a><br>
                Copyright © Gestão de Capital Humano INFOSI {{ date('Y') }} 
            </div>
            {{-- <div class="col-md-4 text-end">
                <a href="#" class="text-white text-decoration-none">Política de Privacidade</a> ·
                <a href="#" class="text-white text-decoration-none">Termos & Condições</a>
            </div> --}}

        </div>
    </div>
</footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.js"
    integrity="sha512-8tHhvNIEwJiw6wQDCVob7hCrwfECKknmtZAdP8JdqZcQ6OEAf1aaErJAzTAL5tQYrcrJOhqS2P3laAuwk4+e5g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> --}}

<!-- Vendors JS -->
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/vendors/js/select2-active.min.js') }}"></script>

<!-- Common JS -->
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>

<!-- Theme Customizer -->
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>

<!-- start Modal Dinâmica Única -->
@include('extra._alerts.index')
<!-- end Modal Dinâmica Única -->

<script>
    //select2
    $('.select2').select2();

    // Abre/fecha sidebar em mobile ao clicar no botão hamburger
    document.querySelector('.navbar-toggler').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
    });

    // Fecha sidebar se clicar fora dela (em mobile)
    document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.sidebar');
        const toggler = document.querySelector('.navbar-toggler');
        if (window.innerWidth < 992 && sidebar.classList.contains('show') && !sidebar.contains(e.target) && !
            toggler.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });

    document.getElementById('themeToggle').addEventListener('click', function() {
        document.querySelector('.theme-panel').classList.toggle('d-none');
    });

    document.getElementById('skin').addEventListener('change', function(e) {
        document.documentElement.setAttribute('data-theme', e.target.value.toLowerCase());
    });

    document.getElementById('typography').addEventListener('change', function(e) {
        document.body.style.fontFamily = e.target.value;
    });

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


    // Modal de Deleção
    document.addEventListener('click', e => {
        const btn = e.target.closest('.delete-btn');
        if (btn) {
            e.preventDefault();
            const url = btn.dataset.url;
            showModal('delete', 'Confirmar Exclusão', 'Tem certeza?', `
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="${url}" class="btn btn-danger">Deletar</a>
                `);
        }
    });

    // Pesquisa dinamica NavBar
    const navInput = document.getElementById('navbarEmployeeSearch');
    const navResults = document.getElementById('navbarSearchResults');
    let navTimeout = null;

    navInput.addEventListener('keyup', function() {

        clearTimeout(navTimeout);
        const query = this.value;

        if (query.length < 2) {
            navResults.innerHTML = '';
            return;
        }

        navTimeout = setTimeout(() => {
            fetch(`{{ route('admin.employeee.navbar.search') }}?q=${query}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.length) {
                        navResults.innerHTML =
                            '<div class="list-group-item text-muted">Nenhum funcionário encontrado</div>';
                        return;
                    }

                    navResults.innerHTML = data.map(item =>
                        `<a href="${item.url}"
                                class="list-group-item list-group-item-action">
                                <i class="fas fa-user me-2 text-primary"></i>
                                ${item.text}
                            </a>`
                    ).join('');
                });
        }, 300); // debounce
    });

    // fechar dropdown ao clicar fora
    document.addEventListener('click', function(e) {
        if (!navInput.contains(e.target)) {
            navResults.innerHTML = '';
        }
    });
</script>
@yield('scripts')
{{-- @stack('scripts') --}}

</body>

</html>
