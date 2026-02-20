@if (session('success') || session('error') || session('warning') || $errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            @if (session('success'))
                showAlert("success", "Sucesso", @json(session('success')));
            @endif

            @if (session('error'))
                showAlert("error", "Erro", @json(session('error')));
            @endif

            @if (session('warning'))
                showAlert("warning", "Atenção", @json(session('warning')));
            @endif

            @if ($errors->any())
                let messages = `<ul style="text-align:left;">`;
                @foreach ($errors->all() as $error)
                    messages += `<li>{{ $error }}</li>`;
                @endforeach
                messages += `</ul>`;

                Swal.fire({
                    icon: "error",
                    title: "Erro de validação",
                    html: messages,
                    confirmButtonText: "Ok"
                });
            @endif

        });
    </script>
@endif
