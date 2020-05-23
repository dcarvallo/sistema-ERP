<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\M_Empresa\Empresa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      $empresa = Empresa::first();
      // dd($empresa);
      if($empresa){
        view()->share('globalimagenempresa', $empresa->imagen_empresa);
        view()->share('globalnombreempresa', $empresa->nombre);
      }
      else{
        view()->share('globalimagenempresa', '');
        view()->share('globalnombreempresa', 'Sistema');
      }
    }
}
