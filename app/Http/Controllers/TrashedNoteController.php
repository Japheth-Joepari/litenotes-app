<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;


use Illuminate\Http\Request;

class TrashedNoteController extends Controller
{
    public function index() {
        $notes = Note::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
    }

    public function show(Note $note) {
        if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        return view('notes.show')->with('note', $note);
    }

    public function update (Note $note) {
        $note->restore();
        return to_route('notes.index')->with('success', 'post restored successfully');
    }

    public function destroy(Note $note) {
         if(!$note->user->is(Auth::user())) {
            return abort(403);
        }

        $note->forceDelete();
        return to_route('notes.index')->with('success', 'Note permanently deleted successfully');
    }
}
