<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

//Recursos humanos
Route::get('rrhh', 'C_RRHH\RecursoshumanoController@index')->name('rrhh.index');

// Route::resource('rrhh', 'C_RRHH\RecursoshumanoController');
// Route::resource('empleados', 'C_RRHH\EmpleadoController');

//empleado

  Route::post('empleados/store', 'C_RRHH\EmpleadoController@store')->name('empleados.store');

	Route::get('empleados', 'C_RRHH\EmpleadoController@index')->name('empleados.index');

	Route::get('empleados/create', 'C_RRHH\EmpleadoController@create')->name('empleados.create');

	Route::put('empleados/{empleado}', 'C_RRHH\EmpleadoController@update')->name('empleados.update');

	Route::get('empleados/{empleado}', 'C_RRHH\EmpleadoController@show')->name('empleados.show');

	Route::delete('empleados/{empleado}', 'C_RRHH\EmpleadoController@destroy')->name('empleados.destroy');

	Route::get('empleados/{empleado}/edit', 'C_RRHH\EmpleadoController@edit')->name('empleados.edit');

});