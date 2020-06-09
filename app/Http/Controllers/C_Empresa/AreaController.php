<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Departamento;
use App\Models\M_Empresa\Area;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;

use Log;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('empresa.area.index');
    }

    public function obtenerareas(Request $request)
    {
      try {
      
        $columns = ['nombre', 'descripcion', 'encargado', 'departamento_id', 'ver','editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = Area::select('id', 'nombre', 'descripcion', 'encargado', 'departamento_id')->with('departamento')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('nombre', 'like', '%' . $searchValue . '%')
                ->orWhere('descripcion', 'like', '%' . $searchValue . '%')
                ->orWhere('encargado', 'like', '%' . $searchValue . '%');
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
        $cargos = Cargo::select('nombre')->get()->toArray();
        $departamentos = Departamento::select('id', 'nombre')->get()->toArray();
        return view('empresa.area.create', compact('departamentos', 'cargos'));
    }

    public function store(Request $request)
    {
     
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'encargado' => 'string|nullable',
            'departamento_id' => 'required'
        ]);
        try {
          
          $area = new Area();
          $area->nombre = $request->nombre;
          $area->descripcion = $request->descripcion;
          $area->encargado = $request->encargado;
          $area->departamento_id = $request->departamento_id;
          $area->save();
          
          $toast = array(
            'title'   => 'Area creada: ',
            'message' => $area->nombre,
            'type'    => 'success'
          );

          return [$area,$toast];
          
        } catch (\Throwable $th) {
          Log::info($th);
            $toast = array(
              'title'   => 'Error',
              'message' => $th,
              'type'    => 'error'
            );
            return [$request, $toast];
        }

    }

    public function show(Area $area)
    {
        return view('empresa.area.show', compact('area'));
    }

    public function edit(Area $area)
    {
      $cargos = Cargo::select('nombre')->get()->toArray();
      $departamentos = Departamento::select('id', 'nombre')->get()->toArray();
      return view('empresa.area.edit', compact('area','cargos', 'departamentos'));
    }

    public function update(Request $request, Area $area)
    {
      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'encargado' => 'string|nullable',
        'departamento_id' => 'required'
        ]);
        
      try {
        $area->nombre = $request->nombre;
        $area->descripcion = $request->descripcion;
        $area->encargado = $request->encargado;
        $area->departamento_id = $request->departamento_id;
        $area->save();
        
        $toast = array(
            'title'   => 'Area modificada: ',
            'message' => $area->nombre,
            'type'    => 'success'
        );

        return [$area ,$toast];
       
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'Error inesperado, contacte al administrdor, '.$th,
          'type'    => 'error'
      );

      return [$request ,$toast];
      }
    }

    public function destroy(Area $area)
    {
      if($area->cargos()->count())
      {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'No se puede quitar, area tiene cargos dependientes',
          'type'    => 'error'
        );
        return $toast;
      }
      $area->delete();

      $toast = array(
        'type'    => 'success',
        'title'   => 'Area eliminada: ',
        'message' => '',
      );
      return $toast;
    }
}
