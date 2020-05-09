<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//general
Route::get('contactos', 'UserController@contactos');

//admin
Route::get('admin', function(){
    return view('admin.index');
});


//usuarios
Route::get('obtenerusuarios', 'UserController@obtenerusuarios');
Route::resource('usuarios', 'UserController');
Route::put('importardatousuario/{id}', 'UserController@importardatousuario');
// Route::get('importardatousuario/{id}', 'UserController@importardatousuario');