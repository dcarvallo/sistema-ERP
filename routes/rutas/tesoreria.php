<?php

use Illuminate\Support\Facades\Route;

//Tesoreria

Route::middleware(['auth'])->group(function () {
	
Route::get('tesoreria', 'C_Tesoreria\TesoreriaController@index')->name('tesoreria.index')
    ->middleware('can:tesoreria.index');
    
});