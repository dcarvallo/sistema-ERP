<?php

namespace App\Http\Controllers\C_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
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
        return view('usuarios.create');
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
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);
            
        try {
            $usuario = new User();
            $usuario->name = $request->name;
            $usuario->username = $request->username;
            $usuario->email = $request->email;
            $usuario->activo = $request->activo;
            $usuario->password = Hash::make($request->password);
            $usuario->save();
            
            $toast = array(
                'title'   => 'Usuario creado: ',
                'message' => $usuario->username,
                'type'    => 'success'
            );

            return redirect('/users/index')->with('mensaje', $toast);

        } catch (\Throwable $th) {
            $toast = array(
                'title'   => 'Usuario no creado: ',
                'message' => $usuario->username,
                'type'    => 'error'
            );
            return redirect('/users/index')->with('mensaje', $toast);
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
        $usuario = User::find($id);
        return view('usuarios.edit', compact('usuario'));
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
        //
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
