<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // 1. LISTAR apenas as notas do usuário logado
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->get();
        return view('notes.index', compact('notes'));
    }

    // 2. MOSTRAR a tela de criação
    public function create()
    {
        return view('notes.create');
    }

    // 3. SALVAR a nota no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Cria a nota vinculada diretamente ao usuário logado
        Auth::user()->notes()->create([
            'title' => $request->title,
            'content' => $request->content, // O Laravel criptografa automaticamente aqui!
        ]);

        return redirect()->route('notes.index')->with('success', 'Nota criada com sucesso!');
    }

    // 4. MOSTRAR a tela de edição (com trava de segurança)
    public function edit(Note $note)
    {
        // Trava de Segurança: Se a nota não for do usuário logado, barra o acesso (Erro 403)
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        return view('notes.edit', compact('note'));
    }

    // 5. ATUALIZAR a nota no banco de dados
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $note->update($request->only(['title', 'content']));

        return redirect()->route('notes.index')->with('success', 'Nota atualizada com sucesso!');
    }

    // 6. EXCLUIR a nota (Soft Delete)
    public function destroy(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }

        $note->delete(); // Guarda a data/hora da exclusão no campo deleted_at automaticamente

        return redirect()->route('notes.index')->with('success', 'Nota excluída com sucesso!');
    }
}