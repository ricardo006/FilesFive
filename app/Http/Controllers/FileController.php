<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request) 
    {
        $showAll = $request->query('showAll', false);
        $files = $showAll ? File::all() : File::where('user_id', Auth::id())->get();

        return view('files.index', compact('files'));
    }

    public function create() 
    {
        return view('files.create');
    }

    // Exibe o formulário de upload
    public function showUploadForm()
    {
        return view('files.upload');
    }

    public function listAllFiles()
    {
        $this->authorize('viewAny', File::class);

        $files = File::all();

        return view('files.all', compact('files'));
    }

    // Lida com o upload do arquivo
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048', // Limite de 2MB
        ]);

        $file = $request->file('file');
        $userId = auth()->id();

        $path = $file->store('uploads');

        $fileRecord = new File();
        $fileRecord->user_id = $userId;
        $fileRecord->file_path = $path;
        $fileRecord->status = 'pending';
        $fileRecord->save();

        return redirect()->route('files.create')
            ->with('success', 'Arquivo enviado com sucesso!')
            ->with('file_path', $path);
    }

    // Lista os arquivos
    public function listFiles()
    {
        $files = Storage::allFiles('uploads');
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

            // Salvando no banco de dados
            $newFile = new File();
            $newFile->user_id = auth()->id();
            $newFile->path = $path;
            $newFile->status = 'pending';
            $newFile->save();

            // Salva o caminho do arquivo no localStorage (no navegador)
            return redirect()->route('files.create')
                ->with('success', 'Arquivo enviado com sucesso.')
                ->with('file_path', $path);
        }

        return redirect()->route('files.create')
            ->withErrors(['file' => 'Nenhum arquivo selecionado.']);
    }


    public function approve($id) 
    {
        $file = File::findOrFail($id);

        $this->authorize('updateStatus', $file);

        $file->status = 'approved';
        $file->save();

        return redirect()->route('files.index', request()->query())->with('success', 'Arquivo aprovado.');
    }

    public function reject($id) 
    {
        $file = File::findOrFail($id);

        $this->authorize('updateStatus', $file);

        $file->status = 'rejected';
        $file->save();

        return redirect()->route('files.index', request()->query())->with('success', 'Arquivo reprovado.');
    }
}