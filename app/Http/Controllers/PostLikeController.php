<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{
    public function store(Post $post, Request $request)
    {
        if($post->likedBy($request->user()))
        {
            return response(null, 409); // Status Code: 409 => Conflict
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
            'post_id' => $request->post->id
        ]);

        // if(!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count())
        // {
        //     Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        // }

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}