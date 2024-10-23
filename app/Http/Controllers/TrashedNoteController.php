<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class TrashedNoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->onlyTrashed()->latest('updated_at')->paginate(5);

        return view('notes.index', compact('notes'));
    }

    public function show(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        return view('notes.show', compact('note'));
    }

    public function update(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }

        $note->restore();

        return to_route('notes.show', compact('note'))->with('success', 'Note restored successfully');
    }

    public function destroy(Note $note){
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $note->forceDelete();

        return to_route('trashed.index', compact('note'))->with('success', 'Note deleted forever successfully');
    }
}
