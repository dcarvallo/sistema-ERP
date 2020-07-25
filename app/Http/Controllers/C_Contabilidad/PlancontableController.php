<?php

namespace App\Http\Controllers\C_Contabilidad;

use App\Models\M_Contabilidad\Plancontable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class PlancontableController extends Controller
{
  
  public function index()
  {
    if(!Auth::user()->can('permisos', 'Navegar-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

    return view('contabilidad.plancontable.index');
  }

  public function obtenerplancontable(Request $request)
  {
    if(!Auth::user()->can('permisos', 'Navegar-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

    $columns = ['elemento','codigo_cta','descripcion','tipo_cta'];
      
    $length = $request->input('length');
    $column = $request->input('column');
    $dir = $request->input('dir');
    $searchValue = $request->input('search');
    $searchColumn = $request->input('searchColumn');
    
    $query = Plancontable::select('id','elemento','codigo_cta','descripcion','tipo_cta')->orderBy($columns[$column], $dir);

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
    if(!Auth::user()->can('permisos', 'Crear-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

    $permisos = Permission::all()->groupBy('category')->toArray();

    $cat = Role::select('category')->whereNotIn('category', ['Admin', 'Inactivo'])->groupBy('category')->get();
    $categorias[] = '';
    foreach($cat as $cate){
        $categorias[] = $cate->category;
    }
    
    return view('admin.plancontable.create', compact('permisos', 'categorias'));;
  }

  public function store(Request $request)
  {
    if(!Auth::user()->can('permisos', 'Crear-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

    $this->validate($request, [
    'name' => 'required|string|unique:plancontable',
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
        'background' => '#e1f6d0',
        'type' => 'success'
      );
      
      return [$rol,$toast];
      
    } catch (\Throwable $th) {
      $toast = array(
        'title'   => 'Rol no creado: ',
        'message' => $rol->name,
        'type'    => 'error',
        'background' => '#edc3c3'
      );
      return [$rol, $toast , $th];
    }

  }

  public function show(Role $role)
  {
    if(!Auth::user()->can('permisos', 'Ver-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);
    if($role->id == 1 || $role->id == 2) return back();
    $permisos = $role->permissions;
    return view('admin.plancontable.show', compact('role', 'permisos'));   
  }

  public function edit($id)
  {
    if(!Auth::user()->can('permisos', 'Editar-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

    $rol = Role::find($id);
    if($rol->id == 1 || $rol->id == 2) return back();
    $permisos = Permission::all()->groupBy('category')->toArray();
    ksort($permisos);

    $cat = Role::select('category')->whereNotIn('category', ['Admin', 'Inactivo'])->groupBy('category')->get();
    foreach($cat as $cate){
        $categorias[] = $cate->category;
    }
    return view('admin.plancontable.edit', compact('rol', 'permisos' , 'categorias'));
  }

  public function update(Request $request, $id)
  {
    if(!Auth::user()->can('permisos', 'Editar-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);

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
          'background' => '#e1f6d0',
          'type' => 'success'
        );
        
        return [$rol,$toast];
        
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Rol no modificado: ',
          'message' => $rol->name,
          'type'    => 'error',
          'background' => '#edc3c3'
        );
        return [$rol, $toast , $th];
      }

  }

  public function destroy($id)
  {
    if(!Auth::user()->can('permisos', 'Eliminar-plancontable') || Auth::user()->hasRole('Inactivo')) abort(403);
    
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
        'background' => '#e1f6d0',
        'type' => 'success'
      );
      return $toast;
  }
}
