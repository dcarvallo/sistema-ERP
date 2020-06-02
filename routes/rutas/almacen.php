<?php

use Illuminate\Support\Facades\Route;

//Almacen
Route::middleware(['auth'])->group(function () {
	

Route::get('almacen', 'C_Almacen\AlmacenController@index')->name('almacen.index')
		->middleware('can:almacen.index');
});