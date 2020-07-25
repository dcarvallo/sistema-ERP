<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Departamento;
use App\Models\M_Empresa\Area;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;
use App\Bitacora;
use Auth;

class AreaController extends Controller
{

    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-areas') || Auth::user()->hasRole('Inactivo')) abort(403);
      
      return view('empresa.area.index');
    }

    public function obtenerareas(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

      try {
      
        $columns = ['nombre', 'descripcion', 'encargado', 'departamento_id'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $searchColumn = $request->input('searchColumn');
        
        $query = Area::select('id', 'nombre', 'descripcion', 'encargado', 'departamento_id')->with('departamento')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue, $searchColumn) {
                $query->where($searchColumn, 'like', '%' . $searchValue . '%');
            });
        }

        $areas = $query->paginate($length);
        return ['data' => $areas, 'draw' => $request->input('draw')];
         
      } catch (\Throwable $th) {
        return $th;
      }
    }

    public function create()
    {
      if(!Auth::user()->can('permisos', 'Crear-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

      $cargos = Cargo::select('nombre')->get()->toArray();
      $departamentos = Departamento::select('id', 'nombre')->get()->toArray();
      return view('empresa.area.create', compact('departamentos', 'cargos'));
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'encargado' => 'string|nullable',
            'departamento' => 'required'
        ]);
        try {

          $area = new Area();
          $area->nombre = $request->nombre;
          $area->descripcion = $request->descripcion;
          $area->encargado = $request->encargado;
          $area->departamento_id = $request->departamento;
          $area->save();
          
          $toast = array(
            'title'   => 'Area creada: ',
            'message' => $area->nombre,
            'background' => '#e1f6d0',
            'type' => 'success'
          );

          $bitacora = new Bitacora();
          $bitacora->mensaje = 'Se creó el área';
          $bitacora->registro_id = $area->id;
          $bitacora->user_id = Auth::user()->id;
          $bitacora->save();

          return [$area, $toast];
          
        } catch (\Throwable $th) {

            $toast = array(
              'title'   => 'Error',
              'messages' => $th,
              'type'    => 'error',
              'background' => '#edc3c3'
            );

            return [$request, $toast];
        }

    }

    public function show(Area $area)
    {
      if(!Auth::user()->can('permisos', 'Ver-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('empresa.area.show', compact('area'));
    }

    public function edit(Area $area)
    {
      if(!Auth::user()->can('permisos', 'Editar-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

      $cargos = Cargo::select('nombre')->get()->toArray();
      $departamentos = Departamento::select('id', 'nombre')->get()->toArray();
      return view('empresa.area.edit', compact('area','cargos', 'departamentos'));
    }

    public function update(Request $request, Area $area)
    {
      if(!Auth::user()->can('permisos', 'Editar-areas') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'encargado' => 'string|nullable',
        'departamento' => 'required'
        ]);
        
      try {
        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->encargado = $request->encargado;
        $area->departamento_id = $request->departamento;
        $area->save();

        $bitacora = new Bitacora();
        $bitacora->mensaje = 'Se editó el área';
        $bitacora->registro_id = $area->id;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->save();
        
        $toast = array(
            'title'   => 'Área modificada: ',
            'message' => $area->nombre,
            'background' => '#e1f6d0',
            'type' => 'success'
        );

        return [$area ,$toast];
       
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'Error inesperado, contacte al administrdor, '.$th,
          'type'    => 'error',
          'background' => '#edc3c3'
      );

      return [$request ,$toast];
      }
    }

    public function destroy(Area $area)
    {
      if(!Auth::user()->can('permisos', 'Eliminar-areas') || Auth::user()->hasRole('Inactivo')) abort(403);
      
      if($area->cargos()->count())
      {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'No se puede quitar, area tiene cargos dependientes',
          'type'    => 'error',
          'background' => '#edc3c3'
        );
        return $toast;
      }
      $area->delete();

      $bitacora = new Bitacora();
      $bitacora->mensaje = 'Se eliminó el área';
      $bitacora->registro_id = $area->id;
      $bitacora->user_id = Auth::user()->id;
      $bitacora->save();

      $toast = array(
        'background' => '#e1f6d0',
        'type' => 'success',
        'title'   => 'Area eliminada: ',
        'message' => '',
      );
      return $toast;
    }
}
