<?php

use Illuminate\Support\Facades\Route;

//admin

//usuarios


Route::middleware(['auth'])->group(function () {
  
  Route::get('perfil', 'C_Usuario\UserController@perfilusuario')->name('perfil');

  Route::get('obtenerusuarios', 'C_Usuario\UserController@obtenerusuarios');

  Route::put('importardatousuario/{id}', 'C_Usuario\UserController@importardatousuario');
	
	//Users
	Route::get('users/create', 'C_Usuario\UserController@create')->name('users.create');

  Route::get('users', 'C_Usuario\UserController@index')->name('users.index');
  
  Route::get('exportar-usuarios', 'C_Usuario\UserController@exportar')->name('users.exportar');

	Route::put('users/{user}', 'C_Usuario\UserController@update')->name('users.update');
    
	Route::put('users/um/{user}', 'C_Usuario\UserController@updateemail')->name('users.updatemail');
    
	Route::put('users/up/{user}', 'C_Usuario\UserController@updatepass')->name('users.updatepass');
    
	Route::put('users/ur/{user}', 'C_Usuario\UserController@updaterol')->name('users.updaterol');

	Route::get('users/{user}', 'C_Usuario\UserController@show')->name('users.show');

	Route::delete('users/{user}', 'C_Usuario\UserController@destroy')->name('users.destroy');

	Route::get('users/{user}/edit', 'C_Usuario\UserController@edit')->name('users.edit');

	Route::post('users/store', 'C_Usuario\UserController@store')->name('users.store');

});