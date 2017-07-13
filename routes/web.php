<?php

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

Auth::routes();

Route::get('/', function () {
    return redirect('/post');
});

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user');


Route::resource('area', 'AreaController', ['only' => [
	'index', 'show'
]]);


Route::get('/post/{id}/history', 'PostController@history')->name('post.history');

Route::resource('post', 'PostController', ['only' => [
	'index', 'create', 'store', 'show', 'edit', 'update'
]]);

Route::resource('comment', 'CommentController', ['only' => [
	'store'
]]);

Route::get('/regras-forum', function () {
	abort(404);
})->name('regras');

Route::get('/test/post/edit/{id}', function($id) {
    $post = \App\Post::findOrFail($id);
    return response()->json($post->getLastText());
});