@if (Auth::check())
    <script>
        // Se o usuário estiver autenticado, realiza o logout automático ao carregar a página pública.
        fetch("{{ route('logout') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                keepalive: true
            })
            .then(() => console.log("Logout automático realizado."))
            .catch(error => console.error("Erro no logout automático:", error));
    </script>
@endif

<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>

<!-- Cabeçalho Completo (Topbar, Branding e Menu) -->
@include('layouts._includes.site.header')

<!-- Conteúdo da Página -->
<div class="page">
    @yield('content')
    <div id="contact-anchor"></div>
</div>

<!-- Rodapé -->
@include('layouts._includes.site.footer')
