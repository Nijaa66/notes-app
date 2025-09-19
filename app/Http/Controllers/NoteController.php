<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Auth::user()->notes()->latest()->paginate(10);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $data['user_id'] = Auth::id();
        Note::create($data);

        return redirect()->route('notes.index')->with('success', 'Note created.');
    }

    public function edit(Note $note)
    {
        $this->authorizeNoteOwner($note);
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $this->authorizeNoteOwner($note);

        $data = $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
        ]);

        $note->update($data);

        return redirect()->route('notes.index')->with('success', 'Note updated.');
    }

    public function destroy(Note $note)
    {
        $this->authorizeNoteOwner($note);
        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted.');
    }

    // helper to ensure users can only manage their own notes
    protected function authorizeNoteOwner(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
