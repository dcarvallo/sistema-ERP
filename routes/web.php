<?php

use Illuminate\Support\Facades\Route;
use App\Models\M_Empresa\Empresa;


Route::get('licence', function(){
  return view('licence');
});

  View::composer(['layouts.adminlayout', 'layouts.template'], function($view){
    $empresa = Empresa::first();

    if($empresa)
    {
      $view->with('globalimagenempresa', $empresa->imagen_empresa)->with('globalnombreempresa', $empresa->nombre);
    }
    else{
      $view->with('globalimagenempresa', '')->with('globalnombreempresa', '');
    }

  });

// Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('password/reset', 'C_Usuario\UserController@showResetForm')->name('password.reset');
Route::post('password/reset', 'C_Usuario\UserController@reset')->name('password.update');


Route::get('/home', 'HomeController@index')->name('home');

//general
Route::get('contactos', 'C_Usuario\UserController@contactos');



