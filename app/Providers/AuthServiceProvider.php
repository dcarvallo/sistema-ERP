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
      
      //para almacenar usuario en cache()
      //   Gate::before(function ($user, $ability) {
      //     $user = cache()->tags('usuarios')->get('usuario_'.$user->id);
      //     if ($user == null ) {
      //       cache()->tags('usuarios')->put('permisos'.Auth::user()->id, Auth::user() );
      //       $user = cache()->tags('permisos')->get('usuario_'.Auth::user()->id);
      //     }
      //   return $user;
      // });

      //para verificar permisos en cache redis @can('permisos', 'el permiso)
      Gate::define('permisos',function ($user, $permiso) 
      {
        $permisosusuario = cache()->tags('permisos')->get('usuario_'.$user->id);
        
        if ($permisosusuario == null ) {
          $perobj = $user->getAllPermissions();
          $permisosarray = array();
          foreach($perobj as $permisos){
            array_push($permisosarray, $permisos->name);
          }
          cache()->tags('permisos')->put('usuario_'.$user->id, $permisosarray);
          $permisosusuario = cache()->tags('permisos')->get('usuario_'.$user->id);
        }
        
        return in_array($permiso, $permisosusuario);

      });
      
    }
}
