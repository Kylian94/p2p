<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/about', function () {
    return view('about');
})->name('about');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'UserController@profil')->name('profil');
Route::post('/editProfil', 'UserController@update')->name('editProfil');


Route::get('/user/{id}', 'UserController@user')->name('userProfil');

Route::get('/posts', 'PostController@show')->name('posts');

Route::post('/createPost', 'PostController@store')->name('createPost');
Route::post('/deletePost', 'PostController@destroy')->name('deletePost');

Route::get('/comments', 'CommentController@show')->name('comments');

Route::post('/createComment', 'CommentController@store')->name('createComment');
Route::post('/deleteComment', 'CommentController@destroy')->name('deleteComment');

Route::post('/createLike', 'LikeController@store')->name('createLike');
Route::post('/deleteLike', 'LikeController@destroy')->name('deleteLike');


Route::get('/friends', 'FriendController@show')->name('friends');

Route::post('/createFriend', 'FriendController@create')->name('createFriend');
Route::post('/acceptFriend', 'FriendController@update')->name('acceptFriend');
Route::post('/deleteFriend', 'FriendController@destroy')->name('deleteFriend');
