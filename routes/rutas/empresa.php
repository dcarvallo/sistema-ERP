<?php

use Illuminate\Support\Facades\Route;

//gestion empresa
// Route::resource('empresas', 'C_Empresa\EmpresaController');
// Route::resource('ubicaciones', 'C_Empresa\UbicacionController');
// Route::resource('areas', 'C_Empresa\AreaController');
// Route::resource('departamentos', 'C_Empresa\DepartamentoController');
// Route::resource('cargos', 'C_Empresa\CargoController');


Route::middleware(['auth'])->group(function () {

	Route::get('obtenerubicaciones', 'C_Empresa\UbicacionController@obtenerubicaciones');

	
	//empresa
	Route::post('empresas/store', 'C_Empresa\EmpresaController@store')->name('empresas.store')
		->middleware('can:empresas.create');

	Route::get('empresas', 'C_Empresa\EmpresaController@index')->name('empresas.index')
		->middleware('can:empresas.index');

	Route::get('empresas/create', 'C_Empresa\EmpresaController@create')->name('empresas.create')
		->middleware('can:empresas.create');

	Route::put('empresas/{product}', 'C_Empresa\EmpresaController@update')->name('empresas.update')
		->middleware('can:empresas.edit');

	Route::get('empresas/{product}', 'C_Empresa\EmpresaController@show')->name('empresas.show')
		->middleware('can:empresas.show');

	Route::delete('empresas/{product}', 'C_Empresa\EmpresaController@destroy')->name('empresas.destroy')
		->middleware('can:empresas.destroy');

	Route::get('empresas/{product}/edit', 'C_Empresa\EmpresaController@edit')->name('empresas.edit')
		->middleware('can:empresas.edit');

		//Ubicacion
	Route::post('ubicaciones/store', 'C_Empresa\UbicacionController@store')->name('ubicaciones.store')
	->middleware('can:ubicaciones.create');

	Route::get('ubicaciones', 'C_Empresa\UbicacionController@index')->name('ubicaciones.index')
		->middleware('can:ubicaciones.index');

	Route::get('ubicaciones/create', 'C_Empresa\UbicacionController@create')->name('ubicaciones.create')
		->middleware('can:ubicaciones.create');

	Route::put('ubicaciones/{product}', 'C_Empresa\UbicacionController@update')->name('ubicaciones.update')
		->middleware('can:ubicaciones.edit');

	Route::get('ubicaciones/{product}', 'C_Empresa\UbicacionController@show')->name('ubicaciones.show')
		->middleware('can:ubicaciones.show');

	Route::delete('ubicaciones/{product}', 'C_Empresa\UbicacionController@destroy')->name('ubicaciones.destroy')
		->middleware('can:ubicaciones.destroy');

	Route::get('ubicaciones/{product}/edit', 'C_Empresa\UbicacionController@edit')->name('ubicaciones.edit')
		->middleware('can:ubicaciones.edit');
});