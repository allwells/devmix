<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    public function index(User $user)
    {
        $posts = auth()->user()->posts()->with(['user', 'likes'])->paginate(20);

        return view('user.post.index', [
            'user' => $user,
            'posts' => $posts
        ]);
    }
}