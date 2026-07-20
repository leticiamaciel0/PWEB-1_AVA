<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('welcome'); });

Route::middleware(['auth', 'verified'])->group(function () {
    // Rotas da Lixeira (Devem vir ANTES do resource)
    Route::get('/notes/trash', [NoteController::class, 'trash'])->name('notes.trash');
    Route::post('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');
    Route::delete('/notes/{id}/force-delete', [NoteController::class, 'forceDelete'])->name('notes.force-delete');
    
    Route::resource('notes', NoteController::class);
});

require __DIR__.'/auth.php';
