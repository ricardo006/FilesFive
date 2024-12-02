@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="card-login">
            <div class="title-login">
                <h2 class="login-title">Login</h2>
            </div>
            <div class="content-form">
                <form class="form-login" method="POST" action="{{ route('login') }}" novalidate>
                    @csrf

                    <label class="" for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email" class="form-control" required>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror

                    <label class="" for="password">Senha</label>
                    <input id="password" type="password" name="password" placeholder="Senha" class="form-control" required>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    
                    <label class="check-left">
                        <input type="checkbox" name="remember" value="1"> Lembrar-me
                    </label>

                    <button type="submit" class="btn btn-entrar">
                        <span class="text-entrar">Entrar</span>
                    </button>

                    <a class="btn btn-inscreva" href="{{ route('register') }}">
                        Inscreva-se
                    </a>
                </form>

                <!-- Exibindo a mensagem de erro geral, se houver -->
                @if(session('errors') && session('errors')->has('general'))
                    <div class="alert alert-danger-message">
                        {{ session('errors')->get('general')[0] }}
                    </div>
                @endif
            </div>
        </div>
    </div>  
@endsection