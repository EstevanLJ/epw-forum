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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/areas', 'AreaController@index')->name('areas');
Route::get('/area/{area}', 'AreaController@show')->name('area');

Route::get('/posts', 'PostController@index')->name('posts');
Route::get('/post/{post}', 'PostController@show')->name('post');

Route::get('/users', 'UserController@index')->name('users');
Route::get('/user/{user}', 'UserController@show')->name('user');
