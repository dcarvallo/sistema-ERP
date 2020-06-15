<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use App\Models\M_Empresa\Empresa;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
        $this->middleware('guest')->except('logout');
    }


    public function username()
    {
        return 'username';
    }

    public function login(\Illuminate\Http\Request $request) {
      $this->validateLogin($request);
  
      if ($this->hasTooManyLoginAttempts($request)) {
          $this->fireLockoutEvent($request);
          return $this->sendLockoutResponse($request);
      }
  
      if ($this->guard()->validate($this->credentials($request))) {
          $user = $this->guard()->getLastAttempted();
  
          if ($user->activo && $this->attemptLogin($request)) {
            //luego de autenticado guardar/obtener en cache sus permisos
            $permisosusuario = cache()->tags('permisos')->get('usuario_'.$user->id);

            if ($permisosusuario == null ) {
              $perobj = $user->getAllPermissions();
              $permisosarray = array();
              foreach($perobj as $permisos){
                array_push($permisosarray, $permisos->name);
              }
              cache()->tags('permisos')->put('usuario_'.$user->id, $permisosarray);
            }

            return $this->sendLoginResponse($request);
          } 
          else {
            $this->incrementLoginAttempts($request);
            return redirect()
                  ->back()
                  ->withInput($request->only($this->username(), 'remember'))
                  ->withErrors(['active' => 'Usuario inactivo.','username' => ' ']);
          }
      }
      $this->incrementLoginAttempts($request);
  
      return $this->sendFailedLoginResponse($request);
  }

    // public function redirectPath()
    // {
    //     if (auth()->user()->hasRole('Inactivo')) {
    //       $this->guard()->logout();

    //         // return redirect('logout')->with('message', 'Usuario inactivo');
    //     }
    //     // else if (auth()->user()->hasRole(['rrhh'])) {
    //     //     return 'gerente';
    //     // }
    //     return property_exists($this, 'redirectTo') ? $this->redirectTo : 'home';
    // }


    // protected function credentials(Request $request)
    // {
    //     return [
    //         'samaccountname' => $request->get('username'),
    //         'password' => $request->get('password'),
    //     ];
    // }
}
