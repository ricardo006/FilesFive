@extends('layouts.app')

@section('content')
    <div class="container-login">
        <div class="card-login">
            <div class="title-login">
                <h2 class="login-title">Cadastro</h2>
            </div>

            <div class="content-form">
                <form class="form-login" method="POST" action="{{ route('register') }}" novalidate>
                    <a class="btn btn-ir-login" href="{{ route('login') }}">
                        <i data-feather="arrow-left" class="feather-18"></i>
                        Voltar
                    </a>

                    @csrf
                    <label for="name">Nome</label>
                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                    <div class="error-message" id="nameError">@error('name') {{ $message }} @enderror</div>

                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
                    <div class="error-message" id="nameError">@error('email') {{ $message }} @enderror</div>

                    <label for="password">Senha</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                    <div class="error-message" id="nameError">@error('password') {{ $message }} @enderror</div>

                    <label for="password_confirmation">Confirmar Senha</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required autocomplete="current-password">
                    <div class="error-message" id="nameError">@error('password_confirmation') {{ $message }} @enderror</div>
                    
                    <button type="submit" class="btn btn-entrar">
                        <span class="text-entrar">Cadastrar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection