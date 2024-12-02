@extends('layouts.app')

@section('content')
    @include('components.navbar') 

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="container-upload">
        <div class="card-upload">
            <h1>Upload de Arquivo</h1>

            <form class="form-enviar-arquivo" action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="file" class="file-label">
                        <i data-feather="upload"></i>
                        <span id="file-name" class="file-name">Nenhum arquivo selecionado</span>
                        <input type="file" id="file" name="file" class="form-control-file" style="display: none;" required>
                    </label>
                </div>

                <button type="submit" class="btn btn-enviar-arquivo">
                    Enviar arquivo
                </button>
            </form>
            
            @if(session('success'))
                <script>
                    let uploadedFilePath = localStorage.getItem('uploadedFilePaths');
                    uploadedFilePath = uploadedFilePath ? JSON.parse(uploadedFilePath) : [];
                    uploadedFilePath.push('{{ session('file_path') }}');
                    localStorage.setItem('uploadedFilePaths', JSON.stringify(uploadedFilePath));
                </script>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('file').addEventListener('change', function() {
            const fileName = this.files.length > 0 ? this.files[0].name : 'Nenhum arquivo selecionado';
            document.getElementById('file-name').textContent = fileName;
        });
    </script>
@endsection
