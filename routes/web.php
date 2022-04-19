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

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/profile/{user:username}', [UserPostController::class, 'index'])->name('user.profile');

Route::get('/', [PostController::class, 'index']);
Route::get('/explore', [PostController::class, 'index'])->name('explore');
Route::post('/explore/{post}', [PostController::class, 'show'])->name('explore.show');
Route::get('/explore/{post}', [PostController::class, 'show'])->name('explore.show');
Route::post('/explore', [PostController::class, 'store']);
Route::delete('/explore/{post}', [PostController::class, 'destroy'])->name('explore.destroy');

Route::post('/explore/{post}/likes', [PostLikeController::class, 'store'])->name('explore.likes');
Route::delete('/explore/{post}/likes', [PostLikeController::class, 'destroy'])->name('explore.likes');