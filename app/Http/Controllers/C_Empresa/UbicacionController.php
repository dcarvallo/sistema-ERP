<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Empresa;
use App\Models\M_Empresa\Ubicacion;
use Illuminate\Http\Request;
use DB;
use Auth;

class UbicacionController extends Controller
{

    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-ubicaciones'))
      {
          abort(403);
      }
        return view('empresa.ubicacion.index');
    }

    public function obtenerubicaciones(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-ubicaciones'))
      {
          abort(403);
      }
      try {
      
        $columns = ['nombre', 'descripcion', 'locacion'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Ubicacion::select('id', 'nombre', 'descripcion', 'locacion', 'empresa_id')->with('Empresa')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('nombre', 'like', '%' . $searchValue . '%')
                ->orWhere('descripcion', 'like', '%' . $searchValue . '%')
                ->orWhere('locacion', 'like', '%' . $searchValue . '%');
            });
        }

        $ubicaciones = $query->paginate($length);
        return ['data' => $ubicaciones, 'draw' => $request->input('draw')];
         
      } catch (\Throwable $th) {
        //throw $th;
      }
    }

    public function create()
    {
      if(!Auth::user()->can('permisos', 'Crear-ubicaciones'))
      {
          abort(403);
      }
        return view('empresa.ubicacion.create');
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-ubicaciones'))
      {
          abort(403);
      }
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'locacion' => 'required|string'
        ]);
        try {
          $empresa = Empresa::first('id');
          
          if($empresa != null)
          {   
            $ubicacion = new Ubicacion();
            $ubicacion->nombre = $request->nombre;
            $ubicacion->descripcion = $request->descripcion;
            $ubicacion->locacion = $request->locacion;
            $ubicacion->empresa_id = $empresa->id;
            $ubicacion->save();
            
            $toast = array(
              'title'   => 'Ubicacion creada: ',
              'message' => $ubicacion->nombre,
              'type'    => 'success'
            );

            return back()->with('toast', $toast);
          }
          else
          {
            $toast = array(
              'title'   => 'error',
              'message' => 'No existe empresa creada',
              'type'    => 'error'
            );
            return back()->with('toast', $toast);
          }
        } catch (\Throwable $th) {
            $toast = array(
              'title'   => 'Error',
              'message' => 'Error inesperado, contacte al administrador',
              'type'    => 'error'
            );
            return back()->with('toast', $toast);
        }

    }

    public function show(Ubicacion $ubicacion)
    {
      if(!Auth::user()->can('permisos', 'Editar-ubicaciones'))
      {
          abort(403);
      }
        return view('empresa.ubicacion.show', compact('ubicacion'));
    }

    public function edit(Ubicacion $ubicacion)
    {
      return view('empresa.ubicacion.edit', compact('ubicacion'));
    }

    public function update(Request $request, Ubicacion $ubicacion)
    {
      if(!Auth::user()->can('permisos', 'Editar-ubicaciones'))
      {
          abort(403);
      }
      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'locacion' => 'required|string'
      ]);
      try {
        $ubicacion->nombre = $request->nombre;
        $ubicacion->descripcion = $request->descripcion;
        $ubicacion->locacion = $request->locacion;
        $ubicacion->save();
        
        $toast = array(
            'title'   => 'Ubicacion modificada: ',
            'message' => $ubicacion->nombre,
            'type'    => 'success'
        );

        return back()->with('toast', $toast);
       
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'Error inesperado, contacte al administrdor',
          'type'    => 'error'
      );

      return back()->with('toast', $toast);
      }
    }

    public function destroy(Ubicacion $ubicacion)
    {
      if(!Auth::user()->can('permisos', 'Eliminar-ubicaciones'))
      {
          abort(403);
      }
      if($ubicacion->departamentos()->count())
      {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'No se puede quitar, ubicacion tiene departamentos dependientes',
          'type'    => 'error'
        );
        return $toast;
      }

      $ubicacion->delete();

      $toast = array(
        'title'   => 'ubicacion eliminada: ',
        'message' => '',
        'type'    => 'error',
      );
      return $toast;
    }
}
