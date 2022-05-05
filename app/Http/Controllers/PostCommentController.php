<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function index(Post $posts)
    {
        return view('post.show', [
            'user' => auth()->user(),
            'post' => $posts,
            'comments' => $posts->comments
        ]);
    }

    public function store(Post $posts, Request $request)
    {
        $this->validate($request, [
            'comments' => 'required'
        ]);

        $posts->comments()->create([
            'user_id' => $request->user()->id,
            'post_id' => $request->posts->id,
            'comments' => $request->comments
        ]);

        return back();
    }

    public function destroy(Post $posts, Request $request)
    {
        $request->user()->comments()->where('post_id', $posts->id)->delete();

        return back();
    }
}