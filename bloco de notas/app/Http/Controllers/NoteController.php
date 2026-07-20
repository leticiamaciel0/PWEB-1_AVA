<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::where('user_id', Auth::id());

        // Requisito: Filtro/Busca por título
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Requisito: Paginação
        $notes = $query->latest()->paginate(6);

        return view('notes.index', compact('notes'));
    }

    public function create() { return view('notes.create'); }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Auth::user()->notes()->create($request->all());
        return redirect()->route('notes.index')->with('success', 'Nota criada com sucesso!');
    }

    public function edit(Note $note)
    {
        Gate::authorize('update', $note); // Requisito: Policy
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        Gate::authorize('update', $note);
        $request->validate(['title' => 'required|max:255', 'content' => 'required']);
        $note->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Nota atualizada!');
    }

    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $note->delete(); // Soft Delete automático
        return redirect()->route('notes.index')->with('success', 'Nota enviada para a lixeira!');
    }

    // Requisito: Página de Lixeira
    public function trash()
    {
        $notes = Note::onlyTrashed()->where('user_id', Auth::id())->latest()->get();
        return view('notes.trash', compact('notes'));
    }

    public function restore($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        Gate::authorize('restore', $note);
        $note->restore();
        return redirect()->route('notes.index')->with('success', 'Nota restaurada com sucesso!');
    }

    public function forceDelete($id)
    {
        $note = Note::onlyTrashed()->findOrFail($id);
        Gate::authorize('forceDelete', $note);
        $note->forceDelete(); // Deleta definitivo do banco
        return redirect()->route('notes.trash')->with('success', 'Nota excluída permanentemente!');
    }
}
