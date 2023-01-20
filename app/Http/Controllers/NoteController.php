<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // without Eloquent relationships
        // $notes = Note::where('user_id', Auth::id())->latest('updated_at')->paginate(5);

        // with Eloquent relationships        
        // $notes = Auth::user()->notes()->latest('updated_at')->paginate(5);

        // with Eloquentrelationships
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);

        // dd($notes);
        // $notes->each(function ($note) {
        //     dump($note->title);
        // });
        return view("notes/index")->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);

          Auth::user()->notes()->create([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
        ]);

        // Note::create([
        //     'uuid' => Str::uuid(),
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'text' => $request->text,
        // ]);
        return to_route('notes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        // $note = Note::where('uuid', $uuid)->where('user_id', Auth::id())->firstOrFail();
        //  if($note->user_id != Auth::id()){
        //     return abort(403);
        // };

        if(!$note->user->is(Auth::user())){
            return abort(403);
        };
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
    //    if($note->user_id != Auth::id()){
    //         return abort(403);
    //     };

        if(!$note->user->is(Auth::user())){
            return abort(403);
        };
        return view('notes.edit')->with('note', $note);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        // if($note->user_id != Auth::id()){
        //     return abort(403);
        // };

        if(!$note->user->is(Auth::user())){
            return abort(403);
        };

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required',
        ]);
        $note->update([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text,
        ]);
        return to_route('notes.show', $note)->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Note $note)
    {
        // if($note->user_id != Auth::id()){
        //     return abort(403);
        // };
        
        if(!$note->user->is(Auth::user())){
            return abort(403);
        };
    
        $note->delete();
        return to_route('notes.index', $note)->with('success', 'Note have been successfully move to the trash can');
    }
}
