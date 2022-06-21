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
  

  //Reportes

  Route::get('reportes-contables', 'C_Contabilidad\ReportescontablesController@index')->name('reportes-contables');

  //Plan Contable

  Route::post('plancontable/store', 'C_Contabilidad\PlancontableController@store')->name('plancontable.store');

  Route::get('plancontable', 'C_Contabilidad\PlancontableController@index')->name('plancontable.index');
  
  Route::get('obtenerplancontable', 'C_Contabilidad\PlancontableController@obtenerplancontable');

	Route::get('plancontable/create', 'C_Contabilidad\PlancontableController@create')->name('plancontable.create');

	Route::put('plancontable/{plancontable}', 'C_Contabilidad\PlancontableController@update')->name('plancontable.update');

	Route::get('plancontable/{plancontable}', 'C_Contabilidad\PlancontableController@show')->name('plancontable.show');

	Route::delete('plancontable/{plancontable}', 'C_Contabilidad\PlancontableController@destroy')->name('plancontable.destroy');

	Route::get('plancontable/{plancontable}/edit', 'C_Contabilidad\PlancontableController@edit')->name('plancontable.edit');
 
});