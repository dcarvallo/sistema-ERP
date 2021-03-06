<?php

use Illuminate\Support\Facades\Route;
use App\Models\M_Empresa\Empresa;

//para limpiar datos de telescope
Route::get('limpiar', function(){
  DB::table('telescope_monitoring')->delete();
  DB::table('telescope_entries_tags')->delete();
  DB::table('telescope_entries')->delete();
  return back();
});

Route::get('licence', function(){
  return view('licence');
});

View::composer(['layouts.adminlayout'], function($view){
  $empresa = cache()->get('datos-empresa');
  if ($empresa == null) {
    $empresa = Empresa::first();
    cache()->put('datos-empresa', $empresa);
  }

  if($empresa)
  {
    $view->with('globalimagenempresa', $empresa->imagen_empresa)->with('globalnombreempresa', $empresa->nombre);
  }
  else{
    $view->with('globalimagenempresa', 'null')->with('globalnombreempresa', 'null');
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
