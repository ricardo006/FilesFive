<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FileController;

// Grupo de rotas de autenticação
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
});


// Grupo de rotas protegidas por autenticação
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::post('/upload', [FileController::class, 'uploadFile'])->name('upload.file');

    Route::get('/files', [FileController::class, 'index'])->name('files.index'); 
    Route::get('/files/all', [FileController::class, 'listAllFiles'])->name('files.all');
    Route::get('/files/create', [FileController::class, 'create'])->name('files.create');
    Route::post('/files/store', [FileController::class, 'store'])->name('files.store'); 
    Route::post('/files/upload', [FileController::class, 'showUploadForm'])->name('upload.form'); 
    Route::resource('files', FileController::class)->except(['create', 'store']);
    Route::put('files/{id}/approve', [FileController::class, 'approve'])->name('files.approve');
    Route::put('files/{id}/reject', [FileController::class, 'reject'])->name('files.reject');

});

// Inclui as rotas de autenticação do Laravel (login, registro, etc.)
require __DIR__.'/auth.php';
