<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\Auth\RegisterController;

// HOME ROUTE (redirects to 'posts')
Route::get('/', function() {
    return redirect()->route('posts');
});

// LOGOUT ROUTE
Route::post('/logout', [LogoutController::class, 'index'])->name('logout');

// LOGIN ROUTE
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// REGISTER USER ROUTE
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// DASHBOARD ROUTE
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// PROFILE ROUTE
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{user:username}', [UserPostController::class, 'index'])->name('user.profile');

// SHOW ALL POSTS
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store']);

// SINGLE-POST ROUTE
Route::get('/posts/{post}', [PostCommentController::class, 'index'])->name('posts.show');
Route::post('/posts/{post}', [PostCommentController::class, 'index']);
Route::delete('/posts/{post}', [PostCommentController::class, 'destroy'])->name('posts.destroy');

// LIKE ROUTE
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');

// COMMENT ROUTE
Route::post('/posts/{post}/comment', [PostCommentController::class, 'store'])->name('posts.comment');
Route::delete('/posts/{post}/comment', [PostCommentController::class, 'destroy'])->name('posts.comment');