@extends('layouts.app')

@section('content')
<div class="container-dashboard">
    @include('components.navbar')   

    <div class="pt-6 bg-white border-b border-gray-200">
        <h2 class="title-page">Dashboard</h2>
        <div class="content-card-dashboard">
            <a href="{{ route('files.create') }}" class="card-upload-arquivos card-upload">
                <div class="card-upload-arquivos-content">
                    <p class="text-upload-dashboard">
                        <h2 class="h2-upload">Upload de Arquivos</h2>
                    </p>
                    <img class="img-files" src="{{ asset('images/svg/files.svg') }}" alt="Imagem de Upload" class="card-image" />
                </div>
            </a>
                                        
            <a href="{{ route('files') }}" class="card-upload-arquivos card-list">
                <div class="card-upload-arquivos-content">
                    <p class="text-listagem-upload">
                        <h2 class="h2-listagem">Listagem de Arquivos</h2>
                    </p>
                    <img class="img-list-files" src="{{ asset('images/svg/listfiles.svg') }}" alt="Listagem de Uploads" class="card-image" />
                </div>
            </a>
        </div>
    </div>
</div>