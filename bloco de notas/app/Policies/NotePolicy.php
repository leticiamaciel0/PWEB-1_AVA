<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;

class NotePolicy
{
    // Garante que o usuário só mexe nas suas próprias notas
    public function view(User $user, Note $note): bool { return $user->id === $note->user_id; }
    public function update(User $user, Note $note): bool { return $user->id === $note->user_id; }
    public function delete(User $user, Note $note): bool { return $user->id === $note->user_id; }
    public function restore(User $user, Note $note): bool { return $user->id === $note->user_id; }
    public function forceDelete(User $user, Note $note): bool { return $user->id === $note->user_id; }
}