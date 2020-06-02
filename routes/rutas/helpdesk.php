<?php

use Illuminate\Support\Facades\Route;

//Helpdesk

Route::middleware(['auth'])->group(function () {

Route::get('helpdesk', 'C_Helpdesk\HelpdeskController@index')->name('helpdesk.index')
		->middleware('can:helpdesk.index');

});