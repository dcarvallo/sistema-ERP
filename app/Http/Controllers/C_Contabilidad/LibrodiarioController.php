<?php

namespace App\Http\Controllers\C_Contabilidad;

use App\Models\M_Contabilidad\Librodiario;
use App\Models\M_Contabilidad\Pcge;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LibrodiarioController extends Controller
{
  
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);
      
      return view('contabilidad.librodiario.index');
    }

    public function obtenerlibrodiarios(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);

      $columns = ['elemento','codigo_cta','descripcion','tipo_cta'];
      
      $length = $request->input('length');
      $column = $request->input('column');
      $dir = $request->input('dir');
      $searchValue = $request->input('search');
      $searchColumn = $request->input('searchColumn');
      
      $query = Librodiario::select('id','elemento','codigo_cta','descripcion','tipo_cta')->orderBy($columns[$column], $dir);

      if ($searchValue) {
          $query->where(function($query) use ($searchValue, $searchColumn) {
              $query->where($searchColumn, 'like', '%' . $searchValue . '%');
          });
      }

      $librodiarios = $query->paginate($length);
      return ['data' => $librodiarios, 'draw' => $request->input('draw')];
    
    }

    public function create()
    {
      if(!Auth::user()->can('permisos', 'Crear-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);

      $cuentas = Pcge::all();
      
      return view('contabilidad.librodiario.create', compact('cuentas'));;
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
      'name' => 'required|string|unique:librodiarios',
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
      if(!Auth::user()->can('permisos', 'Ver-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);
      if($role->id == 1 || $role->id == 2) return back();
      $permisos = $role->permissions;
      return view('admin.librodiarios.show', compact('role', 'permisos'));   
    }

    public function edit($id)
    {
      if(!Auth::user()->can('permisos', 'Editar-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);

      $rol = Role::find($id);
      if($rol->id == 1 || $rol->id == 2) return back();
      $permisos = Permission::all()->groupBy('category')->toArray();
      ksort($permisos);

      $cat = Role::select('category')->whereNotIn('category', ['Admin', 'Inactivo'])->groupBy('category')->get();
      foreach($cat as $cate){
          $categorias[] = $cate->category;
      }
      return view('admin.librodiarios.edit', compact('rol', 'permisos' , 'categorias'));
    }

    public function update(Request $request, $id)
    {
      if(!Auth::user()->can('permisos', 'Editar-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
        'name' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        ]);
        try {
          $rol = Role::find($id);
          if($rol->id == 1 || $rol->id == 2) return back();
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
      if(!Auth::user()->can('permisos', 'Eliminar-librodiarios') || Auth::user()->hasRole('Inactivo')) abort(403);
      
        $rol = Role::find($id);
        if($rol->id == 1 || $rol->id == 2) return back();

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
