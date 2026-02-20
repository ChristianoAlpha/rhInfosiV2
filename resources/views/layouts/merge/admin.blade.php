@include('layouts._includes.admin.header')
@include('layouts._includes.admin.navbar')
@include('layouts._includes.admin.sidebar')
@include('components.alerts')

<main class="nxl-container">
    <div class="nxl-content">
        @yield('content')
    </div>
    @include('components.theme')
    @include('layouts._includes.admin.footer')
</main>
</div>
