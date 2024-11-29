@extends('layouts.app')

@section('content')
    @include('components.navbar')   
    <div class="container">
        

        <div class="table-container">
            <div class="title-table">
                <h1 class="title-page">Meus Arquivos</h1>
            </div>
            <table class="file-table">
                <thead>
                    <tr class="tr-header">
                        <th>Nome do Arquivo</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="fileTableBody">
                    <!-- O conteúdo da tabela será preenchido pelo JavaScript -->
                </tbody>
            </table>
        </div>

        <script>
            // Recupera todos os caminhos de arquivo armazenados no localStorage
            const uploadedFilePaths = JSON.parse(localStorage.getItem('uploadedFilePaths'));

            const fileTableBody = document.getElementById('fileTableBody');

            if (uploadedFilePaths && uploadedFilePaths.length > 0) {
                uploadedFilePaths.forEach((filePath, index) => {
                    const row = document.createElement('tr');

                    // Nome do Arquivo
                    const nameCell = document.createElement('td');
                    nameCell.textContent = `Arquivo ${index + 1}: ${filePath}`;
                    row.appendChild(nameCell);

                    // Status
                    const statusCell = document.createElement('td');
                    statusCell.textContent = 'Pendente';
                    row.appendChild(statusCell);

                    // Ações
                    const actionCell = document.createElement('td');
                    actionCell.className = 'action-cell';

                    // Botão de Visualizar
                    const aprovarButton = document.createElement('button');
                    aprovarButton.textContent = 'Aprovar';
                    aprovarButton.className = 'btn-action btn-aprovar';
                    aprovarButton.innerHTML = `
                        <i data-feather="check"></i> Aprovar
                    `;
                    aprovarButton.onclick = () => {
                        alert(`Aprovar: ${filePath}`);
                        
                    };

                    // Botão de Reprovar
                    const reprovarButton = document.createElement('button');
                    reprovarButton.textContent = 'Reprovar';
                    reprovarButton.className = 'btn-action btn-reprovar';
                    reprovarButton.innerHTML = `
                        <i data-feather="x-circle"></i>  Reprovar
                    `;

                    reprovarButton.onclick = () => {
                        alert(`Reprovar: ${filePath}`);
                        // Lógica para baixar o arquivo pode ser adicionada aqui
                    };

                    actionCell.appendChild(aprovarButton);
                    actionCell.appendChild(reprovarButton);
                    row.appendChild(actionCell);

                    // Adiciona a linha à tabela
                    fileTableBody.appendChild(row);
                });
            } else {
                const emptyRow = document.createElement('tr');
                const emptyCell = document.createElement('td');
                emptyCell.textContent = 'Nenhum arquivo foi encontrado';
                emptyCell.colSpan = 3;
                emptyCell.style.textAlign = 'center';
                emptyRow.appendChild(emptyCell);
                fileTableBody.appendChild(emptyRow);
            }
        </script>
    </div>
@endsection
