<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('users/create', function(){
// 	return 'test';
// });



Route::get('/home', 'HomeController@index')->name('home');

//general
Route::get('contactos', 'C_Admin\UserController@contactos');



