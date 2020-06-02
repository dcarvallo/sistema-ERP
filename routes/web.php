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

Auth::routes();
Route::get('/', 'Auth\LoginController@login');


Route::get('/home', 'HomeController@index')->name('home');

//general
Route::get('contactos', 'C_Usuario\UserController@contactos');



