@include('layouts._includes.admin.header')
@include('layouts._includes.admin.navbar')
@include('layouts._includes.admin.sidebar')

    <main class="container-fluid p-4">
        @yield('content')
    </main>
    @include('components.theme')
</div>
@include('layouts._includes.admin.footer')
