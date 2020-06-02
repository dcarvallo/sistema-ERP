<?php

use Illuminate\Support\Facades\Route;

//admin

Route::middleware(['auth'])->group(function () {
	
  Route::get('admin', 'C_Admin\AdminController@index')->name('admin.index')
		->middleware('can:admin.index');

	Route::get('filemanager', 'C_Admin\AdminController@gestionararchivos')->name('admins.archivos')
		->middleware('can:admins.archivo');
	
	//Roles
	Route::post('roles/store', 'C_Admin\RoleController@store')->name('roles.store')
		->middleware('can:roles.create');

	Route::get('roles', 'C_Admin\RoleController@index')->name('roles.index')
		->middleware('can:roles.index');

	Route::get('roles/create', 'C_Admin\RoleController@create')->name('roles.create')
		->middleware('can:roles.create');

	Route::put('roles/{role}', 'C_Admin\RoleController@update')->name('roles.update')
		->middleware('can:roles.edit');

	Route::get('roles/{role}', 'C_Admin\RoleController@show')->name('roles.show')
		->middleware('can:roles.show');

	Route::delete('roles/{role}', 'C_Admin\RoleController@destroy')->name('roles.destroy')
		->middleware('can:roles.destroy');

	Route::get('roles/{role}/edit', 'C_Admin\RoleController@edit')->name('roles.edit')
    ->middleware('can:roles.edit');
    
  Route::get('obtenerroles', 'C_Admin\RoleController@obtenerroles');

  //Permissions
  
  Route::post('permisos/store', 'C_Admin\PermissionController@store')->name('permisos.store')
		->middleware('can:permisos.create');

	Route::get('permisos', 'C_Admin\PermissionController@index')->name('permisos.index')
		->middleware('can:permisos.index');

	Route::get('permisos/create', 'C_Admin\PermissionController@create')->name('permisos.create')
		->middleware('can:permisos.create');

	Route::put('permisos/{permission}', 'C_Admin\PermissionController@update')->name('permisos.update')
		->middleware('can:permisos.edit');

	Route::get('permisos/{permission}', 'C_Admin\PermissionController@show')->name('permisos.show')
		->middleware('can:permisos.show');

	Route::delete('permisos/{permission}', 'C_Admin\PermissionController@destroy')->name('permisos.destroy')
		->middleware('can:permisos.destroy');

	Route::get('permisos/{permission}/edit', 'C_Admin\PermissionController@edit')->name('permisos.edit')
    ->middleware('can:permisos.edit');
    
  Route::get('obtenerpermisos', 'C_Admin\PermissionController@obtenerpermisos');


});