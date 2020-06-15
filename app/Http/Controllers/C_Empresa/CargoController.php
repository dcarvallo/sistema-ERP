<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Area;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;
use Auth;

class CargoController extends Controller
{

    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('empresa.cargo.index');
    }

    public function obtenercargos(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

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
      if(!Auth::user()->can('permisos', 'Crear-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      $areas = Area::select('id', 'nombre')->get()->toArray();
      return view('empresa.cargo.create', compact('areas'));
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
          'nombre' => 'required|string',
          'descripcion' => 'required|string',
          'area' => 'required',
      ]);
      try {
        
        $cargo = new Cargo();
        $cargo->nombre = $request->nombre;
        $cargo->descripcion = $request->descripcion;
        $cargo->area_id = $request->area;
        $cargo->save();
        
        $toast = array(
          'title'   => 'Cargo creado: ',
          'message' => $cargo->nombre,
          'type'    => 'success'
        );

        return [$cargo, $toast];
        
      } catch (\Throwable $th) {
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
      if(!Auth::user()->can('permisos', 'Ver-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('empresa.cargo.show', compact('cargo'));
    }

    public function edit(Cargo $cargo)
    {
      if(!Auth::user()->can('permisos', 'Editar-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      $areas = Area::select('id', 'nombre')->get()->toArray();
      return view('empresa.cargo.edit', compact('cargo', 'areas'));
    }

    public function update(Request $request, Cargo $cargo)
    {
      if(!Auth::user()->can('permisos', 'Editar-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);

      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'area' => 'required'
        ]);
        
      try {
        $cargo->nombre = $request->nombre;
        $cargo->descripcion = $request->descripcion;
        $cargo->area_id = $request->area;
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
      if(!Auth::user()->can('permisos', 'Eliminar-cargos') || Auth::user()->hasRole('Inactivo')) abort(403);
      
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
