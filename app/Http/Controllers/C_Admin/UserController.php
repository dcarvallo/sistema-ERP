<?php

namespace App\Http\Controllers\C_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use DB;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
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
                ->orWhere('username', 'like', '%' . $searchValue . '%');
            });
        }

        $usuarios = $query->paginate($length);
        return ['data' => $usuarios, 'draw' => $request->input('draw')];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombres' => 'required|string',
            'apellidos' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
        try {
          $usuario = new User();
          $usuario->nombres = $request->nombres;
          $usuario->apellidos = $request->apellidos;
          $usuario->name = $request->nombres.' '.$request->apellidos;
          $usuario->username = $request->username;
          $usuario->email = $request->email;
          $usuario->activo = $request->activo;
          $usuario->password = Hash::make($request->password);
          Log::info($request);
          if($request->imagen)
          {
              $ext = $request->imagen->getClientOriginalExtension();
              $fileName = str_random().'.'.$ext;
              $request->imagen->storeAs('usuarios/', $fileName);
              $usuario->fotografia = 'usuarios/'.$fileName;
          }
          else
          {
            $usuario->fotografia = 'usuariodef/avatar.png';
          }

          
          $usuario->save();
          $array = explode(",", $request->roles);
          $usuario->syncRoles($array);
          
          $toast = array(
            'title'   => 'Usuario creado: ',
            'message' => $request->username,
            'type'    => 'success'
          );

          return [$usuario,$toast];

          } catch (\Throwable $th) {
              $toast = array(
                  'title'   => 'Usuario no creado: ',
                  'message' => $usuario->username,
                  'type'    => 'error'
              );
              return [$usuario, $toast , $th];
          }

            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      Log::info($request);
      $this->validate($request, [
        'nombres' => 'required|string',
        'apellidos' => 'required|string',
        'username' => 'required|string',
      ]);

      
      try {
        $usuario = User::find($id);
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->username = $request->username;
        $usuario->activo = $request->activo;
        
        if($request->imagen)
        {
          $ext = $request->imagen->getClientOriginalExtension();
          $fileName = str_random().'.'.$ext;
          $request->imagen->storeAs('usuarios/', $fileName);
          $usuario->fotografia = 'usuarios/'.$fileName;
        }
        $usuario->save();
        
        $toast = array(
            'title'   => 'Usuario modificado: ',
            'message' => $usuario->username,
            'type'    => 'success'
        );

        // return redirect('/users/index')->with('mensaje', $toast);
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
        
        $array = explode(",", $request->roles);
        $usuario->syncRoles($array);
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        
        // $usuarios = DB::table('users')->orderBy('name', 'asc')->paginate(10);
       

    }
}
