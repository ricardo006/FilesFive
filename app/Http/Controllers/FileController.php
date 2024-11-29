<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class FileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        $files = Storage::files('uploads');

        return view('files.index', compact('files'));
    }

    
    public function create() {
        return view('files.create');
    }

    // Exibe o formulário de upload
    public function showUploadForm()
    {
        return view('files.upload');
    }

    // Lida com o upload do arquivo
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048', // Limite de 2MB
        ]);

        $path = $request->file('file')->store('uploads');

        return redirect()->route('upload.form')->with('success', 'Arquivo enviado com sucesso!');
    }

    // Lista os arquivos
    public function listFiles()
    {
        $files = Storage::allFiles('uploads');
        dd($files);
        return view('files.list', compact('files'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->storeAs('uploads', $file->getClientOriginalName());

            // Salva o caminho do arquivo no localStorage (no navegador)
            return redirect()->route('files.create')
                ->with('success', 'Arquivo enviado com sucesso.')
                ->with('file_path', $path);
        }

        return redirect()->route('files.create')
            ->withErrors(['file' => 'Nenhum arquivo selecionado.']);
    }


    public function approve($id) {
        $file = File::findOrFail($id);
        $file->status = 'approved';
        $file->save();

        return redirect()->route('files.index')->with('success', 'Arquivo aprovado.');
    }

    public function reject($id) {
        $file = File::findOrFail($id);
        $file->status = 'rejected';
        $file->save();

        return redirect()->route('files.index')->with('error', 'Arquivo reprovado.');
    }
}