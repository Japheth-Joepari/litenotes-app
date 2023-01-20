<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Note extends Model
{
    use HasFactory;

    // for allowing fillable mass assignment
    protected $guarded = [];
    // public function  getRouteKeyName(Note $note)
    //  {
    //     if($note->user_id != Auth::id()){
    //         return abort(403);
    //     };
    //     return view('notes.show')->with('note', $note);
    // }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
