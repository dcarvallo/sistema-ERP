<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Departamento;
use App\Models\M_Empresa\Ubicacion;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;

use Log;

class DepartamentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('empresa.departamento.index');
    }

    public function obtenerdepartamentos(Request $request)
    {
      try {
      
        $columns = ['nombre', 'descripcion', 'encargado', 'ubicacion_id', 'ver','editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Departamento::select('id', 'nombre', 'descripcion', 'encargado', 'ubicacion_id')->with('ubicacion')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('nombre', 'like', '%' . $searchValue . '%')
                ->orWhere('descripcion', 'like', '%' . $searchValue . '%')
                ->orWhere('encargado', 'like', '%' . $searchValue . '%');
            });
        }

        $departamentos = $query->paginate($length);
        return ['data' => $departamentos, 'draw' => $request->input('draw')];
         
      } catch (\Throwable $th) {
        //throw $th;
      }
    }

    public function create()
    {
        $cargos = Cargo::select('nombre')->get()->toArray();
        $ubicaciones = Ubicacion::select('id', 'nombre')->get()->toArray();
        return view('empresa.departamento.create', compact('ubicaciones', 'cargos'));
    }

    public function store(Request $request)
    {
      Log::info($request);
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'ubicacion_id' => 'required'
        ]);
        try {
          
          $departamento = new Departamento();
          $departamento->nombre = $request->nombre;
          $departamento->descripcion = $request->descripcion;
          $departamento->encargado = $request->encargado;
          $departamento->ubicacion_id = $request->ubicacion_id;
          $departamento->save();
          
          $toast = array(
            'title'   => 'Departamento creado: ',
            'message' => $departamento->nombre,
            'type'    => 'success'
          );

          return [$departamento,$toast];
          
        } catch (\Throwable $th) {
          Log::info($th);
            $toast = array(
              'title'   => 'Error',
              'message' => $th,
              'type'    => 'error'
            );
            return [$request,$toast];
        }

    }

    public function show(Departamento $departamento)
    {
        return view('empresa.departamento.show', compact('departamento'));
    }

    public function edit(Departamento $departamento)
    {
      $cargos = Cargo::select('nombre')->get()->toArray();
      $ubicaciones = Ubicacion::select('id', 'nombre')->get()->toArray();
      return view('empresa.departamento.edit', compact('departamento','cargos', 'ubicaciones'));
    }

    public function update(Request $request, Departamento $departamento)
    {
      $this->validate($request, [
        'nombre' => 'required|string',
        'descripcion' => 'required|string',
        'ubicacion_id' => 'required'
      ]);
      try {
        $departamento->nombre = $request->nombre;
        $departamento->descripcion = $request->descripcion;
        $departamento->encargado = $request->encargado;
        $departamento->ubicacion_id = $request->ubicacion_id;
        $departamento->save();
        
        $toast = array(
            'title'   => 'Departamento modificado: ',
            'message' => $departamento->nombre,
            'type'    => 'success'
        );

        return [$departamento ,$toast];
       
      } catch (\Throwable $th) {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'Error inesperado, contacte al administrdor',
          'type'    => 'error'
      );

      return [$request ,$toast];
      }
    }

    public function destroy(Departamento $departamento)
    {
      if($departamento->areas()->count())
      {
        $toast = array(
          'title'   => 'Error: ',
          'message' => 'No se puede quitar, departamento tiene areas dependientes',
          'type'    => 'error'
        );
        return $toast;
      }
      $departamento->delete();

      $toast = array(
        'type'    => 'success',
        'title'   => 'Departamento eliminado: ',
        'message' => '',
      );
      return $toast;
    }
}
