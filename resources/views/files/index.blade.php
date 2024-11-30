@extends('layouts.app')

@section('content')
    @include('components.navbar')   
    <div class="container">
        
        <div class="table-container">
            <div class="title-table">
                <h1 class="title-page">Meus Arquivos</h1>
                <div class="group-buttons-actions">
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
                </div>
            </div>
            <table class="file-table">
                <thead>
                    <tr class="tr-header">
                        <th>Nome do Arquivo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($files as $file)
                        <tr>
                            <td>{{ $file->path }}</td>
                            <td>{{ ucfirst($file->status) }}</td>
                            <td class="action-cell">
                                <!-- Verificar se o usuário tem permissão -->
                                @can('updateStatus', $file)
                                    <!-- Botão de Aprovar -->
                                    <form action="{{ route('files.approve', $file->id) }}?showAll={{ request('showAll') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action btn-aprovar">
                                            <i data-feather="check"></i> 
                                            Aprovar
                                        </button>
                                    </form>

                                    <!-- Botão de Reprovar -->
                                    <form action="{{ route('files.reject', $file->id) }}?showAll={{ request('showAll') }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action btn-reprovar">
                                            <i data-feather="x-circle"></i> 
                                            Reprovar
                                        </button>
                                    </form>
                                @else
                                    <!-- Caso o usuário não tenha permissão -->
                                    <span>Sem permissões</span>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center;">Nenhum arquivo foi encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
