<?php

use Illuminate\Support\Facades\Route;

//Contabilidad
Route::middleware(['auth'])->group(function () {
	
  Route::get('contabilidad', 'C_Contabilidad\ContabilidadController@index')->name('contabilidad.index');
  

  //libro diario
  Route::post('librodiarios/store', 'C_Contabilidad\LibrodiarioController@store')->name('librodiarios.store');

  Route::get('librodiarios', 'C_Contabilidad\LibrodiarioController@index')->name('librodiarios.index');
  
  Route::get('obtenerlibrodiarios', 'C_Contabilidad\LibrodiarioController@obtenerlibrodiarios');

	Route::get('librodiarios/create', 'C_Contabilidad\LibrodiarioController@create')->name('librodiarios.create');

	Route::put('librodiarios/{librodiario}', 'C_Contabilidad\LibrodiarioController@update')->name('librodiarios.update');

	Route::get('librodiarios/{librodiario}', 'C_Contabilidad\LibrodiarioController@show')->name('librodiarios.show');

	Route::delete('librodiarios/{librodiario}', 'C_Contabilidad\LibrodiarioController@destroy')->name('librodiarios.destroy');

	Route::get('librodiarios/{librodiario}/edit', 'C_Contabilidad\LibrodiarioController@edit')->name('librodiarios.edit');
  
});