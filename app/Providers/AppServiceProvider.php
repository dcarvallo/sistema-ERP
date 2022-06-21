<?php

namespace App\Providers;
use RefreshDatabase;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
      if ($this->app->isLocal()) {
        $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        $this->app->register(TelescopeServiceProvider::class);
    }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      if(config('app.env') === 'production'){
        URL::forceScheme('https');
      }
    }
}
