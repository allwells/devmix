<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(User $user, Post $post)
    {
        return view('post.show', [
            'user' => auth()->user(),
            'post' => $post
        ]);
    }

    public function store(Post $post, Request $request)
    {
        $post->comments()->create([
            'user_id' => auth()->user()->id,
            'post_id' => $request->post->id,
            'comments' => $request->comments
        ]);

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->comments()->where('post_id', $post->id)->delete();

        return back();
    }
}