<?php

namespace App\Http\Controllers\C_Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use App\Http\Requests\Usuarios\StoreUsuario;
use App\Http\Requests\Usuarios\ResetPassword;
use App\Http\Requests\Usuarios\UpdateUsuario;
use App\Models\M_RRHH\Empleado;
use Log;
use Storage;
use File;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('usuarios.index');
    }

    public function obtenerusuarios(Request $request)
    {
        $columns = ['name', 'username', 'email', 'activo'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = User::select('id', 'name', 'username', 'email', 'activo')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('username', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $usuarios = $query->paginate($length);
        return ['data' => $usuarios, 'draw' => $request->input('draw')];
    }

    public function create()
    {
      $empleados = Empleado::select('id', 'nombres', 'apellidos', 'ci')->get();
      // $roles = Role::orderBy('name', 'asc')->get();

      $roles = Role::all()->groupBy('category')->toArray();
      ksort($roles);

      return view('usuarios.create', compact('roles', 'empleados'));
    }

    public function store(StoreUsuario $request)
    {
      try {
        $usuario = new User();
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->name = $request->nombres.' '.$request->apellidos;
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->activo = $request->activo;
        $usuario->password = Hash::make($request->password);
        if($request->empleado_id)
        { 
          $usuario->empleado_id = $request->empleado_id;
        }
        if($request->imagen)
        {
          //laravel intervention

          $ext = $request->imagen->getClientOriginalExtension();
          $fileName = str_random().'.'.$ext;
          //original
          $request->imagen->storeAs('usuarios/originales', $fileName);
          //modificado
          $imagenmod = Image::make($request->imagen)->fit(300, 300);
          Storage::put('usuarios/thumbnail/'.$fileName, $imagenmod->encode() );

          $usuario->fotografia = 'usuarios/thumbnail/'.$fileName;
        }
        else
        {
          $usuario->fotografia = 'usuariodef/avatar.png';
        }

        $usuario->save();
        
        if($request->roles)
        {
          $array = explode(",", $request->roles);
          $usuario->syncRoles($array);
        }
          
        $toast = array(
          'title'   => 'Usuario creado: ',
          'message' => $request->username,
          'type'    => 'success'
        );

        return [$usuario,$toast];

      } catch (\Illuminate\Database\QueryException $e) {
          $toast = array(
              'title'   => 'Usuario no creado: ',
              'message' => $usuario->username,
              'type'    => 'error'
          );
          return [$usuario, $toast , $e->errorInfo];
      }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(UpdateUsuario $request, $id)
    {
      
      try {
        $usuario = User::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->name = $request->nombres.' '.$request->apellidos;
        $usuario->activo = $request->activo;
        
        if($request->imagen)
        {
          // $ext = $request->imagen->getClientOriginalExtension();
          // $fileName = str_random().'.'.$ext;
          // $request->imagen->storeAs('usuarios/', $fileName);
          // $usuario->fotografia = 'usuarios/'.$fileName;

          //laravel intervention

          $ext = $request->imagen->getClientOriginalExtension();
          $fileName = str_random().'.'.$ext;
          //original
          $request->imagen->storeAs('usuarios/originales', $fileName);
          //modificado
          $imagenmod = Image::make($request->imagen)->fit(300, 300);
          Storage::put('usuarios/thumbnail/'.$fileName, $imagenmod->encode() );

          $usuario->fotografia = 'usuarios/thumbnail/'.$fileName;

        }
        $usuario->save();
        
        $toast = array(
            'title'   => 'Usuario modificado: ',
            'message' => $usuario->username,
            'type'    => 'success'
        );

        return [$usuario,$toast];

      } catch (\Throwable $th) {
          $toast = array(
              'title'   => 'Usuario no modificado: ',
              'message' => 'error',
              'type'    => 'error'
          );
          return response()->json($usuario,$toast);
      }

    }


    public function destroy($id)
    {
      $usuario = User::find($id);
       $usuario->delete();
       $toast = array(
         'title'   => 'usuario eliminado: ',
         'message' => '',
       );
       return $toast;
    }

    public function updatepass(Request $request, $id)
    {
      $this->validate($request, [
        'password' => 'string|min:6'
      ]);

      
      try {
        $usuario = User::find($id);
        if($request->password)
        {
          $usuario->password = Hash::make($request->password);
        }
        
        $usuario->save();
        
        $toast = array(
            'title'   => 'Usuario modificado: ',
            'message' => $usuario->username,
            'type'    => 'success'
        );
        return [$usuario,$toast];

      } catch (\Throwable $th) {
          $toast = array(
              'title'   => 'Usuario no modificado: ',
              'message' => 'error',
              'type'    => 'error'
          );
          return response()->json($usuario,$toast);
      }
    }

    public function updateemail(Request $request, $id)
    {
      $this->validate($request, [
        'email' => 'email|unique:users',
      ]);
      
      try {
        $usuario = User::find($id);
        if($request->email)
        {
          $usuario->email = $request->email;
        }
        
        $usuario->save();
        
        $toast = array(
            'title'   => 'Email modificado: ',
            'message' => $usuario->email,
            'type'    => 'success'
        );
        return [$usuario,$toast];

      } catch (\Throwable $th) {
          $toast = array(
              'title'   => 'Usuario no modificado: ',
              'message' => 'error',
              'type'    => 'error'
          );
          return response()->json($usuario,$toast);
      }
    }

    public function updaterol(Request $request, $id)
    {
      try {
        
        $usuario = User::find($id);
        if($request->roles)
        {
          $arrayderoles = explode(",", $request->roles);
          $usuario->syncRoles($arrayderoles);
          $toast = array(
            'title'   => 'roles modificados para: ',
            'message' => $usuario->username,
            'type'    => 'success'
          );
        }
        else{
          $usuario->removeRoles($usuario->roles);
          $toast = array(
            'title'   => 'roles modificados para: ',
            'message' => $usuario->username,
            'type'    => 'success'
          );
        }
        
        
        return [$usuario,$toast];

      } catch (\Throwable $th) {
          $toast = array(
              'title'   => 'Usuario no modificado: ',
              'message' => 'error',
              'type'    => 'error'
          );
          return [$usuario,$toast];
      }
    }

    public function contactos()
    {
        $usuarios = User::paginate(9);
        return view('rrhh.contactos',compact('usuarios'));
    }

    public function importardatousuario(Request $request, $id)
    {

        try {
            $usuario = User::find($id);
            $usuario->activo = 1;
            $usuario->save();
            //colocar comando de importacion de active directory
            // $uno = "ldap";
            // $dos = $usuario->username;
            // Artisan::call('route:list');
            
        } catch (\Throwable $th) {
            //throw $th;
        }
        
       
    }

    public function perfilusuario()
    {
      
      $usuario = User::find(Auth::user()->id);
      return view('usuarios.perfil', compact('usuario'));
    }

    public function showResetForm()
    {
      return view('auth.passwords.reset');
    }

    public function reset(ResetPassword $request)
    {

      $user = User::find(Auth::user()->id);

      $user->password = Hash::make($request->nuevo);

      $user->save();

      $msg = 'Contraseña cambiada';

      Session::flash('resetpass', $msg);

      return redirect('perfil');

    }
}
