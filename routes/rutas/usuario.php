<?php

use Illuminate\Support\Facades\Route;

//admin

//usuarios


Route::middleware(['auth'])->group(function () {
  
  Route::get('perfilusuario', 'C_Usuario\UserController@perfilusuario')->name('perfilusuario');

	Route::get('obtenerusuarios', 'C_Usuario\UserController@obtenerusuarios');

	Route::put('importardatousuario/{id}', 'C_Usuario\UserController@importardatousuario');
	
	//Users
	Route::get('users/create', 'C_Usuario\UserController@create')->name('users.create')
		->middleware('can:users.create');

	Route::get('users/index', 'C_Usuario\UserController@index')->name('users.index')
		->middleware('can:users.index');

	Route::put('users/{user}', 'C_Usuario\UserController@update')->name('users.update')
    ->middleware('can:users.edit');
    
	Route::put('users/um/{user}', 'C_Usuario\UserController@updateemail')->name('users.updatemail')
    ->middleware('can:users.edit');
    
	Route::put('users/up/{user}', 'C_Usuario\UserController@updatepass')->name('users.updatepass')
    ->middleware('can:users.edit');
    
	Route::put('users/ur/{user}', 'C_Usuario\UserController@updaterol')->name('users.updaterol')
		->middleware('can:users.edit');

	Route::get('users/{user}', 'C_Usuario\UserController@show')->name('users.show')
		->middleware('can:users.show');

	Route::delete('users/{user}', 'C_Usuario\UserController@destroy')->name('users.destroy')
		->middleware('can:users.destroy');

	Route::get('users/{user}/edit', 'C_Usuario\UserController@edit')->name('users.edit')
		->middleware('can:users.edit');

	Route::post('users/store', 'C_Usuario\UserController@store')->name('users.store')
		->middleware('can:users.store');
	


});