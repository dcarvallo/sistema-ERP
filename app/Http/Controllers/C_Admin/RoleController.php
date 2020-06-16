<?php

namespace App\Http\Controllers\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Bitacora;
use DB;
use Auth;

class RoleController extends Controller
{
    
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('admin.roles.index');
    }

    public function obtenerroles(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      $columns = ['name', 'description', 'category', 'ver', 'editar', 'eliminar'];

      $length = $request->input('length');
      $column = $request->input('column');
      $dir = $request->input('dir');
      $searchValue = $request->input('search');

      $query = Role::select('id', 'name', 'description','category')->orderBy($columns[$column], $dir);

      if ($searchValue) {
          $query->where(function($query) use ($searchValue) {
              $query->where('name', 'like', '%' . $searchValue . '%')
              ->orWhere('description', 'like', '%' . $searchValue . '%')
              ->orWhere('category', 'like', '%' . $searchValue . '%');
          });
      }

      $roles = $query->paginate($length);
      return ['data' => $roles, 'draw' => $request->input('draw')];
    }

    public function create()
    {
      if(!Auth::user()->can('permisos', 'Crear-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      $permisos = Permission::all()->groupBy('category')->toArray();
      ksort($permisos);
      $cat = Role::select('category')->groupBy('category')->get();
      foreach($cat as $cate){
          $categorias[] = $cate->category;
      }
      // dd($categorias);
      // $permisos = Permission::select('id', 'name', 'description', 'category')->get()->toArray();
      
      return view('admin.roles.create', compact('permisos', 'categorias'));;
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
      'name' => 'required|string',
      'description' => 'required|string',
      'category' => 'required|string',
      ]);
      try {
        $rol = new Role();
        $rol->name = $request->name;
        $rol->guard_name = 'web';
        $rol->description = $request->description;
        $rol->category = $request->category;
        
        $rol->save();
        
        
        if($request->permisos)
        {
          $array = explode(",", $request->permisos);
          $rol->syncPermissions($array);
          cache()->tags('permisos')->flush();
        }
        
        $bitacora = new Bitacora();
        $bitacora->mensaje = 'Se creó el rol';
        $bitacora->registro_id = $rol->id;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->save();

        $toast = array(
          'title'   => 'Rol creado: ',
          'message' => $request->name,
        );
        
        return [$rol,$toast];
        
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Rol no creado: ',
          'message' => $rol->name,
        );
        return [$rol, $toast , $th];
      }

    }

    public function show(Role $role)
    {
      if(!Auth::user()->can('permisos', 'Ver-roles') || Auth::user()->hasRole('Inactivo')) abort(403);
      $permisos = $role->permissions;
      return view('admin.roles.show', compact('role', 'permisos'));   
    }

    public function edit($id)
    {
      if(!Auth::user()->can('permisos', 'Editar-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      $rol = Role::find($id);
      $permisos = Permission::all()->groupBy('category')->toArray();
      ksort($permisos);

      $cat = Role::select('category')->groupBy('category')->get();
      foreach($cat as $cate){
          $categorias[] = $cate->category;
      }
      return view('admin.roles.edit', compact('rol', 'permisos' , 'categorias'));
    }

    public function update(Request $request, $id)
    {
      if(!Auth::user()->can('permisos', 'Editar-roles') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
        'name' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        ]);
        try {
          $rol = Role::find($id);
          $rol->name = $request->name;
          $rol->description = $request->description;
          $rol->category = $request->category;
          
          $rol->save();
          
          if($request->permisos)
          {
            $array = explode(",", $request->permisos);
            $rol->syncPermissions($array);
            cache()->tags('permisos')->flush();
          }
          
          $bitacora = new Bitacora();
          $bitacora->mensaje = 'Se editó el rol';
          $bitacora->registro_id = $rol->id;
          $bitacora->user_id = Auth::user()->id;
          $bitacora->save();

          $toast = array(
            'title'   => 'Rol modificado: ',
            'message' => $request->name,
          );
          
          return [$rol,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'Rol no modificado: ',
            'message' => $rol->name,
          );
          return [$rol, $toast , $th];
        }

    }

    public function destroy($id)
    {
      if(!Auth::user()->can('permisos', 'Eliminar-roles') || Auth::user()->hasRole('Inactivo')) abort(403);
      
      $rol = Role::find($id);
        $rol->delete();

        $bitacora = new Bitacora();
        $bitacora->mensaje = 'Se eliminó el rol';
        $bitacora->registro_id = $rol->id;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->save();

        $toast = array(
          'title'   => 'Rol eliminado: ',
          'message' => '',
        );
        return $toast;
    }
}
