<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Area;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;

use Log;

class CargoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('empresa.cargo.index');
    }

    public function obtenercargos(Request $request)
    {
      try {
      
        $columns = ['nombre', 'descripcion', 'area_id', 'ver','editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        
        $query = Cargo::select('id', 'nombre', 'descripcion', 'area_id')->with('Area')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('nombre', 'like', '%' . $searchValue . '%')
                ->orWhere('descripcion', 'like', '%' . $searchValue . '%');
            });
        }

        $cargos = $query->paginate($length);
        return ['data' => $cargos, 'draw' => $request->input('draw')];
         
      } catch (\Throwable $th) {
        return $th;
      }
    }

    public function create()
    {
        $areas = Area::select('id', 'nombre')->get()->toArray();
        return view('empresa.cargo.create', compact('areas'));
    }

    public function store(Request $request)
    {
     
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'area_id' => 'required',
        ]);
        try {
          
          $cargo = new Cargo();
          $cargo->nombre = $request->nombre;
          $cargo->descripcion = $request->descripcion;
          $cargo->area_id = $request->area_id;
          $cargo->save();
          
          $toast = array(
            'title'   => 'Cargo creado: ',
            'message' => $cargo->nombre,
            'type'    => 'success'
          );

          return [$cargo, $toast];
          
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

    public function show(Cargo $cargo)
    {
        return view('empresa.cargo.show', compact('cargo'));
    }

    public function edit(Cargo $cargo)
    {
      $areas = Area::select('id', 'nombre')->get()->toArray();
      return view('empresa.cargo.edit', compact('cargo', 'areas'));
    }

    public function update(Request $request, Cargo $cargo)
    {
      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'area_id' => 'required'
        ]);
        
      try {
        $cargo->nombre = $request->nombre;
        $cargo->descripcion = $request->descripcion;
        $cargo->encargado = $request->encargado;
        $cargo->departamento_id = $request->departamento_id;
        $cargo->save();
        
        $toast = array(
            'title'   => 'Cargo modificado: ',
            'message' => $cargo->nombre,
            'type'    => 'success'
        );

        return [$cargo ,$toast];
       
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'Error inesperado, contacte al administrador, '.$th,
          'type'    => 'error'
      );

      return [$request ,$toast];
      }
    }

    public function destroy(Cargo $cargo)
    {
      if($cargo->empleado()->count())
      {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'No se puede quitar, cargo tiene empleados dependientes',
          'type'    => 'error'
        );
        return $toast;
      }
      $cargo->delete();

      $toast = array(
        'type'    => 'success',
        'title'   => 'Cargo eliminado: ',
        'message' => '',
      );
      return $toast;
    }
}
