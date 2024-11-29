@extends('layouts.app')

@section('content')
    @include('components.navbar')   
    <div class="container-upload">

        <div class="card-upload">
            <h1>Upload de Arquivo</h1>

            <form class="form-enviar-arquivo" action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file">Escolha um arquivo</label>
                    <input type="file" name="file" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-enviar-arquivo">
                    Enviar arquivo
                </button>
            </form>
            
            @if(session('success'))
                <script>
                    // Salva o caminho do arquivo no localStorage
                    let uploadedFilePath = localStorage.getItem('uploadedFilePaths');
                    uploadedFilePath = uploadedFilePath ? JSON.parse(uploadedFilePath) : [];
                    uploadedFilePath.push('{{ session('file_path') }}');
                    localStorage.setItem('uploadedFilePaths', JSON.stringify(uploadedFilePath));
                </script>
            @endif
        </div>
    </div>
@endsection
