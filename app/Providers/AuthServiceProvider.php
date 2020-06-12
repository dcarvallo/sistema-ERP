<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
      $this->registerPolicies();

      // Implicitly grant "Super Admin" role all permissions
      // This works in the app by using gate-related functions like auth()->user->can() and @can()
      Gate::before(function ($user, $ability) {
        return $user->hasRole('Super Admin') ? true : null;
      });

      // Gate::define('permiso',function ($permiso) {
      //   $permisosusuario = Auth::user()->getAllPermissions();
      //   return $permisosusuario->include($permiso);
      // });
      

      Gate::define('permisos',function ($user, $permiso) {
        logger($permiso);
        $permisosusuario = cache()->tags('permisos')->get('usuario_'.Auth::user()->id);
        logger($permisosusuario);
        if ($permisosusuario == null ) {
          
          $perobj = $user->getAllPermissions();
          $permisosarray = array();
          foreach($perobj as $permisos){
            array_push($permisosarray, $permisos->name);
          }

          cache()->put('permisos'.$user->id, $permisosarray);
          $permisosusuario = cache()->tags('permisos')->get('usuario_'.Auth::user()->id);
        }
        
        return in_array($permiso, $permisosusuario);

      });
      
    }
}
