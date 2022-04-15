<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        return view('post.index');
    }

    public function createPost(Request $request) {
        dd($request->body);
    }
}