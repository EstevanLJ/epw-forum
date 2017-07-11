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
    return redirect('/posts');
});

Route::get('/areas', 'AreaController@index')->name('areas');
Route::get('/area/{area}', 'AreaController@show')->name('area');

Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user');



//API routes -> achar um jeito de passar para o arquivo API e funcionar a autenticacao
Route::resource('api/area', 'Api\AreaController', ['only' => [
'index', 'store', 'show', 'update'
]]);

Route::get('api/area/{area}/posts', 'Api\AreaController@getPosts');


Route::resource('api/post', 'Api\PostController', ['only' => [
'index', 'show'
]]);

Route::resource('api/comment', 'Api\CommentController', ['only' => [
'store'
]]);

Route::get('/test/bulma', function() {
    $post = \App\Post::first();
	return view('post_bulma', compact('post'));
});