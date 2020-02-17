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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/inscription', 'Auth\RegisterController@showRegistrationForm');

Route::resource('billets', 'BilletController');
Route::resource('comments', 'CommentController');
Route::get('/comments/create/{id}', 'CommentController@create')->name('MakeComment');
Route::post('/comments/store/{id}', 'CommentController@store')->name('CreateComment');

