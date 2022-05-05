<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentLikesController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function store(Comment $comments, Request $request)
    {
        if($comments->likedBy($request->user()))
        {
            return response(null, 409); // Status Code: 409 => Conflict
        }

        dd($request->comment);

        // $comment->likes()->create([
        //     'user_id' => auth()->user()->id,
        // ]);

        return back();
    }

    public function destroy(Comment $comment, Request $request)
    {
        $request->user()->likes()->where('comment_id', $comment->id)->delete();

        return back();
    }

    public function delete_comment(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}