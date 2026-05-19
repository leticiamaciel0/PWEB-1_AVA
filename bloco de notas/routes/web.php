<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// TUDO AQUI DENTRO SÓ É ACESSADO APÓS O LOGIN (ÁREA RESTRITA)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Quando o usuário entrar no painel, ele será levado direto para as notas
    Route::get('/dashboard', function () {
        return redirect()->route('notes.index');
    });

    // Esse comando cria todas as 6 rotas do CRUD de uma vez só!
    Route::resource('notes', NoteController::class);

    // Rotas padrão do perfil (criadas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';