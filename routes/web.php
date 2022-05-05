<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\Auth\RegisterController;


Route::group(['middleware' => 'auth'], function() {
    // LOGOUT ROUTE
    Route::post('/logout', 'Auth\LogoutController@index')->name('logout');

    // DASHBOARD ROUTE
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    // CREATE POST ROUTE
    Route::get('/create', 'PostController@create_post')->name('create');
    Route::post('/create', 'PostController@store');

    // LIKE AND UNLIKE ROUTES WHEN SHOWING SINGLE POST
    Route::post('/posts/{post:id}', 'PostLikeController@store')->name('posts.like');
    Route::delete('/posts/{post:id}', 'PostLikeController@destroy')->name('posts.unlike');

    // COMMENT ROUTE
    Route::post('/posts/{posts:id}/comments', 'PostCommentController@store')->name('posts.comment');
    Route::delete('/posts/{post:id}/comments', 'PostCommentController@destroy')->name('posts.comment');

    // COMMENT-LIKES ROUTE
    Route::post('/posts/{posts:id}/like', 'CommentLikesController@store')->name('posts.like.comment');
    Route::delete('/posts/{posts:id}/unlike', 'CommentLikesController@store')->name('posts.unlike.comment');
});

Route::group(['middleware' => 'guest'], function() {
    // LOGIN ROUTE
    Route::get('/login', 'Auth\LoginController@index')->name('login');
    Route::post('/login', 'Auth\LoginController@store');

    // REGISTER USER ROUTE
    Route::get('/register', 'Auth\RegisterController@index')->name('register');
    Route::post('/register', 'Auth\RegisterController@store');
});






// HOME ROUTE (redirects to 'posts')
Route::get('/', function() { return redirect()->route('posts'); });

// SHOW ALL POSTS
Route::get('/posts', 'PostController@index')->name('posts');

// PROFILE ROUTE
Route::get('/{user:username}', 'ProfileController@index')->name('profile');
Route::get('/{user:username}/profile', 'UserPostController@index')->name('user.profile');

// GET SINGLE POST
Route::get('/posts/{posts:id}', 'PostCommentController@index')->name('posts.show');
Route::delete('/posts/{posts:id}', 'PostController@destroy')->name('posts.destroy');
Route::delete('/posts/{posts:id}', 'PostCommentController@destroy')->name('posts.destroy');