<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//general
Route::get('contactos', 'C_Admin\UserController@contactos');

//admin
Route::get('admin', function(){
    return view('admin.index');
});

//usuarios
Route::get('obtenerusuarios', 'C_Admin\UserController@obtenerusuarios');
Route::resource('usuarios', 'C_Admin\UserController');
Route::put('importardatousuario/{id}', 'C_Admin\UserController@importardatousuario');
// Route::get('importardatousuario/{id}', 'UserController@importardatousuario');

//Recursos humanos
Route::resource('rrhh', 'C_RRHH\RecursoshumanoController');
Route::get('empleados', 'C_RRHH\RecursoshumanoController@listaEmpleados');


//gestion empresa
Route::resource('empresa', 'C_Empresa\EmpresaController');
