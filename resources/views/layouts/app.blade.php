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
    </head> 
    <body>
        <div class="min-h-screen bg-gray-100">
            <!-- Conteúdo da página -->
            @yield('content')
        </div>

        <!-- Carregar scripts na ordem correta -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Carregar Feather Icons -->
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const alert = document.querySelector('.alert');

                if (alert) {
                    setTimeout(() => {
                        alert.style.opacity = 0;

                        setTimeout(() => {
                            alert.remove();
                        }, 1000);
                    }, 3000);
                }
            });
        </script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sessionUserName = "{{ session('userName', 'Usuário') }}";
                const sessionUserEmail = "{{ session('userEmail', 'Email') }}";
                const sessionUserId = "{{ session('userId', 'Usuário') }}";

                let storedUserName = localStorage.getItem('userName');
                let storedUserEmail = localStorage.getItem('userEmail');
                
                if (sessionUserName !== 'Usuário' && sessionUserName !== storedUserName) {
                    localStorage.setItem('userName', sessionUserName);
                    storedUserName = sessionUserName;
                }
                
                if (sessionUserEmail !== 'Email' && sessionUserEmail !== storedUserEmail) {
                    localStorage.setItem('userEmail', sessionUserEmail);
                    storedUserEmail = sessionUserEmail;
                }

                const usernameElement = document.getElementById('username');
                if (usernameElement) 
                    usernameElement.textContent = `Bem Vindo, ${storedUserName}!`;

                const usernameNavbarElement = document.getElementById('usernamenavbar');
                if (usernameNavbarElement) 
                    usernameNavbarElement.innerHTML = `${storedUserName} <i data-feather="user" class="feather-18"></i>`;

                feather.replace();
            });
        </script>
    </body>
</html>
