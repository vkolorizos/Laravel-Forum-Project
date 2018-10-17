<?php


Route::get('/', function () {
	return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('threads', 'ThreadController@index')->name('threads.index');
Route::get('threads/create', 'ThreadController@create')->name('threads.create');
Route::get('threads/{channel}', 'ThreadController@index');
Route::get('threads/{channel}/{thread}', 'ThreadController@show');
Route::post('threads', 'ThreadController@store');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::post('/replies/{reply}/favorites', 'FavoriteController@store');

Route::get('/profiles/{user}', 'ProfileController@show')->name('profile');