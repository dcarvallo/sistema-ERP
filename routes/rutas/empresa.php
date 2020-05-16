<?php

use Illuminate\Support\Facades\Route;

//gestion empresa
// Route::resource('empresas', 'C_Empresa\EmpresaController');
Route::resource('ubicaciones', 'C_Empresa\UbicacionController');
Route::resource('areas', 'C_Empresa\AreaController');
Route::resource('departamentos', 'C_Empresa\DepartamentoController');
Route::resource('cargos', 'C_Empresa\CargoController');


Route::middleware(['auth'])->group(function () {
	
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
});