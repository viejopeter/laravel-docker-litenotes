<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);

        return view('notes.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $notebooks = Notebook::where('user_id', Auth::id())->get();
        return view('notes.create')->with('notebooks', $notebooks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

        $note = Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text,
            'notebook_id'=> $request->notebook_id,
        ]);

        return to_route('notes.show', ['note' => $note]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        return view('notes.show', ['note' => $note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $notebooks = Notebook::where('user_id', Auth::id())->get();

        return view('notes.edit', ['note' => $note,'notebooks' => $notebooks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {

        if (!$note->user->is(Auth::user())) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);
        $attributes = $request->only(['title', 'text', 'notebook_id']);
        $note->update($attributes);
        return to_route('notes.show', ['note' => $note])->with('success', 'Note updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if (!$note->user->is(Auth::user())) {
            abort(403);
        }
        $note->delete();
        return to_route('notes.index')->with('success', 'Note move to trash.');
    }
}
