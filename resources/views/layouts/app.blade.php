<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FileFive') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Carregar CSS principal (se necessário) -->
        <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <!-- Importar o JavaScript de notificações -->
        <script src="{{ asset('js/notifications.js') }}" defer></script>
        
        <!-- Carregar a biblioteca SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head> 
    <body>
        <div class="min-h-screen bg-gray-100">

            <!-- Page Heading -->
            @if(isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content') <!-- Use a section for the content -->
            </main>
        </div>

        <!-- Definir a variável de mensagem de sucesso do Blade -->
        <script>
            @if(session('success'))
                window.successMessage = "{{ session('success') }}";
            @else
                window.successMessage = null;
            @endif
        </script>

        <!-- Importar o arquivo principal de JavaScript que usa a função de notificação -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ mix('js/app.js') }}"></script>

        <!-- Carregar scripts na ordem correta -->
        <script src="{{ mix('js/notifications.js') }}" defer></script>

        <!-- Carregar Feather Icons -->
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace();
        </script>
    </body>
</html>
