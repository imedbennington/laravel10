<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Idea;
class IdeasLikesController extends Controller
{
    public function like(Idea $idea)
    {
        $liker = auth()->user();

        $like = new Likes();
        $like->user()->associate($liker);
        $like->idea()->associate($idea);
        $like->save();

        return redirect()->route('dashboard')->with('success', 'Post liked');
    }

    public function unlike (Idea $idea){
        {
            $liker = auth()->user();
    
            // Find the like record
            $like = Likes::where('user_id', $liker->id)
                         ->where('idea_id', $idea->id)
                         ->first();
    
            if ($like) {
                $like->delete();
                return redirect()->route('dashboard')->with('success', 'Post unliked');
            } else {
                return redirect()->route('dashboard')->with('error', 'Like not found');
            }
        }
    }
}
