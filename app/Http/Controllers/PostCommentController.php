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

    public function index(User $user)
    {
        return view('post.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function store(Post $post, Request $request)
    {

        // if($post->commentedBy($request->user()))
        // {
        //     return response(null, 409); // Conflict
        // }

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comments' => $request->comments
        ]);

        // if(!$post->comments()->onlyTrashed()->where('user_id', $request->user()->id)->count())
        // {
        //     Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        // }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->comments()->where('post_id', $post->id)->delete();

        return back();
    }
}