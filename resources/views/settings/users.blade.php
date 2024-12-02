@extends('layouts.app')

@section('title', 'Configurações de Usuários')

@section('content')
    @include('components.navbar')   

    <div class="container-config-users">
        <div class="title-table-settings">
            <h1>
                <i data-feather="users"></i>
                Configurações de Usuários
            </h1>
            <p>Gerencie as permissões de usuários aqui.</p>
        </div>
        
        <div class="table-container-users">
            <table class="file-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Usuário</th>
                        <th>Email</th>
                        <th>Administrador</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                            <td>
                                @if(!$user->is_admin)
                                    <form action="{{ route('users.makeAdmin', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action btn-aprovar">
                                            <i data-feather="globe"></i>    
                                            Tornar Admin
                                        </button>
                                    </form>
                                @else
                                    <span>Já é admin</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">Nenhum usuário encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
