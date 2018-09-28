<?php


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('threads','ThreadController');
Route::post('/threads/{thread}/replies','ReplyController@store');