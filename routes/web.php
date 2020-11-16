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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'HomeController@index');
Route::get('/login', 'LoginController@index');
Route::post('/login', 'LoginController@login')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/register', 'RegisterController@index')->name('register.index');
Route::post('/register', 'RegisterController@register')->name('register');
Route::post('/posts/{post}/comments', 'PostController@comment')->name('comment');
Route::get('/posts/{post}/like', 'PostController@like')->name('like');

Route::resource('posts', 'PostController');