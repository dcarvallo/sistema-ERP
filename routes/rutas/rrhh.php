<?php

use Illuminate\Support\Facades\Route;

//Recursos humanos
Route::resource('rrhh', 'C_RRHH\RecursoshumanoController');
Route::resource('empleados', 'C_RRHH\EmpleadoController');


