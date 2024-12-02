@extends('layouts.app')

@section('title', 'Configurações')

@section('content')
    @include('components.navbar')   
    
    <div class="container">
        <div class="table-container">
            <div class="title-table-settings">
                <h1 class="title-page-settings">
                    <i data-feather="settings"></i>    
                    Configurações
                </h1>
                <p>Gerencie as configurações da sua conta e preferências</p>

                <!-- <div class="group-buttons-actions">
                    <a 
                        href="{{ route('files.index', ['showAll' => true]) }}" 
                        class="btn btn-allFiles {{ request('showAll') == '1' ? 'ativo' : '' }}">
                        <i data-feather="file-text" size="16"></i>    
                        Todos Arquivos
                    </a>
                    <a 
                        href="{{ route('files.index', ['showAll' => false]) }}" 
                        class="btn btn-myFiles {{ request('showAll') == '0' ? 'ativo' : '' }}">
                        <i data-feather="file" size="16"></i>    
                        Meus Arquivos
                    </a>
                </div> -->
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-config">
                        <div class="card-body">
                            <h5 class="card-title-settings">Configurações de Usuários</h5>
                            <p class="card-text-settings">Gerencie permissões e privilégios dos usuários.</p>
                        </div>
                        <a href="{{ route('settings.users') }}" class="config-btn-container">
                            <div class="btn">
                                <i data-feather="users"></i> 
                                <span class="text-item-settings">Gerenciar Usuários</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-config">
                        <div class="card-body">
                            <h5 class="card-title-settings">
                                <span>Configurações do Sistema</span>
                            </h5>
                            <p class="card-text-settings">Ajuste as preferências globais do sistema.</p>
                        </div>
                        <a href="#" class="config-btn-container">
                            <div class="btn">
                                <i data-feather="settings"></i> 
                                <span class="text-item-settings">Configurar Sistema</span>
                            </div>
                        </a>
                    </div>
                </div>
                
            </div>
            
            @if(request()->routeIs('settings.users'))
                <div class="table-container mt-5">
                    <h2>Gerenciar Usuários</h2>
                    <table class="file-table">
                        <thead>
                            <tr class="tr-header">
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Email</th>
                                <th>Admin</th>
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
                                    <td class="action-cell">
                                        @if(!$user->is_admin)
                                            <form action="{{ route('users.makeAdmin', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn-action btn-make-admin">
                                                    <i data-feather="user-plus"></i> 
                                                    Tornar Admin
                                                </button>
                                            </form>
                                        @else
                                            <span>Já é Admin</span>
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
            @endif
        </div>
    </div>
@endsection