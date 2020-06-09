<?php

use Illuminate\Support\Facades\Route;

//gestion empresa
// Route::resource('empresas', 'C_Empresa\EmpresaController');
// Route::resource('ubicaciones', 'C_Empresa\UbicacionController');
// Route::resource('areas', 'C_Empresa\AreaController');
// Route::resource('departamentos', 'C_Empresa\DepartamentoController');
// Route::resource('cargos', 'C_Empresa\CargoController');


Route::middleware(['auth'])->group(function () {

	//empresa
	Route::post('empresas/store', 'C_Empresa\EmpresaController@store')->name('empresas.store')
		->middleware('can:empresas.create');

	Route::get('empresas', 'C_Empresa\EmpresaController@index')->name('empresas.index')
		->middleware('can:empresas.index');

	Route::get('empresas/create', 'C_Empresa\EmpresaController@create')->name('empresas.create')
		->middleware('can:empresas.create');

	Route::put('empresas/{empresa}', 'C_Empresa\EmpresaController@update')->name('empresas.update')
		->middleware('can:empresas.edit');

	Route::get('empresas/{empresa}', 'C_Empresa\EmpresaController@show')->name('empresas.show')
		->middleware('can:empresas.show');

	Route::delete('empresas/{empresa}', 'C_Empresa\EmpresaController@destroy')->name('empresas.destroy')
		->middleware('can:empresas.destroy');

	Route::get('empresas/{empresa}/edit', 'C_Empresa\EmpresaController@edit')->name('empresas.edit')
		->middleware('can:empresas.edit');

    //Ubicacion
    
	Route::get('obtenerubicaciones', 'C_Empresa\UbicacionController@obtenerubicaciones')->middleware('can:ubicaciones.index');

	Route::post('ubicaciones/store', 'C_Empresa\UbicacionController@store')->name('ubicaciones.store')
	->middleware('can:ubicaciones.create');

	Route::get('ubicaciones', 'C_Empresa\UbicacionController@index')->name('ubicaciones.index')
		->middleware('can:ubicaciones.index');

	Route::get('ubicaciones/create', 'C_Empresa\UbicacionController@create')->name('ubicaciones.create')
		->middleware('can:ubicaciones.create');

	Route::put('ubicaciones/{ubicacion}', 'C_Empresa\UbicacionController@update')->name('ubicaciones.update')
		->middleware('can:ubicaciones.edit');

	Route::get('ubicaciones/{ubicacion}', 'C_Empresa\UbicacionController@show')->name('ubicaciones.show')
		->middleware('can:ubicaciones.show');

	Route::delete('ubicaciones/{ubicacion}', 'C_Empresa\UbicacionController@destroy')->name('ubicaciones.destroy')
		->middleware('can:ubicaciones.destroy');

	Route::get('ubicaciones/{ubicacion}/edit', 'C_Empresa\UbicacionController@edit')->name('ubicaciones.edit')
    ->middleware('can:ubicaciones.edit');
    
  //Departamento
	Route::get('obtenerdepartamentos', 'C_Empresa\DepartamentoController@obtenerdepartamentos')->middleware('can:departamentos.index');

  Route::post('departamentos/store', 'C_Empresa\DepartamentoController@store')->name('departamentos.store')
  ->middleware('can:departamentos.create');

  Route::get('departamentos', 'C_Empresa\DepartamentoController@index')->name('departamentos.index')
    ->middleware('can:departamentos.index');

  Route::get('departamentos/create', 'C_Empresa\DepartamentoController@create')->name('departamentos.create')
    ->middleware('can:departamentos.create');

  Route::put('departamentos/{departamento}', 'C_Empresa\DepartamentoController@update')->name('departamentos.update')
    ->middleware('can:departamentos.edit');

  Route::get('departamentos/{departamento}', 'C_Empresa\DepartamentoController@show')->name('departamentos.show')
    ->middleware('can:departamentos.show');

  Route::delete('departamentos/{departamento}', 'C_Empresa\DepartamentoController@destroy')->name('departamentos.destroy')
    ->middleware('can:departamentos.destroy');

  Route::get('departamentos/{departamento}/edit', 'C_Empresa\DepartamentoController@edit')->name('departamentos.edit')
    ->middleware('can:departamentos.edit');


  //Area
  Route::get('obtenerareas', 'C_Empresa\AreaController@obtenerareas')->middleware('can:areas.index');

	Route::post('areas/store', 'C_Empresa\AreaController@store')->name('areas.store')
	->middleware('can:areas.create');

	Route::get('areas', 'C_Empresa\AreaController@index')->name('areas.index')
		->middleware('can:areas.index');

	Route::get('areas/create', 'C_Empresa\AreaController@create')->name('areas.create')
		->middleware('can:areas.create');

	Route::put('areas/{area}', 'C_Empresa\AreaController@update')->name('areas.update')
		->middleware('can:areas.edit');

	Route::get('areas/{area}', 'C_Empresa\AreaController@show')->name('areas.show')
		->middleware('can:areas.show');

	Route::delete('areas/{area}', 'C_Empresa\AreaController@destroy')->name('areas.destroy')
		->middleware('can:areas.destroy');

	Route::get('areas/{area}/edit', 'C_Empresa\AreaController@edit')->name('areas.edit')
		->middleware('can:areas.edit');


  //Cargo
  Route::get('obtenercargos', 'C_Empresa\CargoController@obtenercargos')->middleware('can:cargos.index');

	Route::post('cargos/store', 'C_Empresa\CargoController@store')->name('cargos.store')
	->middleware('can:cargos.create');

	Route::get('cargos', 'C_Empresa\CargoController@index')->name('cargos.index')
		->middleware('can:cargos.index');

	Route::get('cargos/create', 'C_Empresa\CargoController@create')->name('cargos.create')
		->middleware('can:cargos.create');

	Route::put('cargos/{cargo}', 'C_Empresa\CargoController@update')->name('cargos.update')
		->middleware('can:cargos.edit');

	Route::get('cargos/{cargo}', 'C_Empresa\CargoController@show')->name('cargos.show')
		->middleware('can:cargos.show');

	Route::delete('cargos/{cargo}', 'C_Empresa\CargoController@destroy')->name('cargos.destroy')
		->middleware('can:cargos.destroy');

	Route::get('cargos/{cargo}/edit', 'C_Empresa\CargoController@edit')->name('cargos.edit')
		->middleware('can:cargos.edit');

});