<?php

use Illuminate\Support\Facades\Route;

//Contabilidad
Route::middleware(['auth'])->group(function () {
	
Route::get('contabilidad', 'C_Contabilidad\ContabilidadController@index')->name('contabilidad.index');

});