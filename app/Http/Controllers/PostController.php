<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth'])->only(['store', 'destroy', 'create_post']);
    // }

    public function index()
    {

        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);

        return view('post.index', ['posts' => $posts]);
    }

    public function create_post()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);


        $request->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        return \redirect('/posts');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return back();
    }

}