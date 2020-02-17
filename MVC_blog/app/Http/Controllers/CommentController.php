<?php

namespace App\Http\Controllers;

use App\Billet;
use App\Comment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $id)
    {
        $request->validate([
            'comment' => 'required|max:140',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
            'billet_id' => $id,
        ]);

        return back();

    }

    public function destroy(Comment $comment)
    {
        if($comment->user_id != Auth::id())
        {
            return back()
                            ->with('warning', "vous n'avez pas les droit pour suprimer ce Comment");

        }
        else
        {
            $comment->delete();

        return back()
                            ->with('success', 'Comment delete successfully.');
        }
    }
}
