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

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user');


Route::resource('area', 'AreaController', ['only' => [
	'index', 'show'
]]);

Route::resource('post', 'PostController', ['only' => [
	'index', 'create', 'show'
]]);

Route::resource('comment', 'CommentController', ['only' => [
	'store'
]]);

// Route::get('/test/bulma', function() {
//     //$post = \App\Post::first();
//     return view('auth.login_bulma');
// });