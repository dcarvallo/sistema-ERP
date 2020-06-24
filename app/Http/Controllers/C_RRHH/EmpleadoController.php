<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Models\M_RRHH\Empleado;
use Illuminate\Http\Request;
use Auth;
class EmpleadoController extends Controller
{


    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
      // $empleado = Empleado::find(1);
      // dd($empleado->cargo->nombre);
      return view('rrhh.empleados.index');
    }

    public function obtenerempleados(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Navegar-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);

      $columns = ['empleado_id', 'nombres', 'apellidos', 'ci', 'tipo_contrato', 'fecha_contrato'];
      
      $length = $request->input('length');
      $column = $request->input('column');
      $dir = $request->input('dir');
      $searchValue = $request->input('search');
      $searchColumn = $request->input('searchColumn');
      
      $query = Empleado::select('id', 'empleado_id', 'nombres', 'apellidos', 'ci', 'tipo_contrato', 'fecha_contrato', 'cargo_id')->with('Cargo')->orderBy($columns[$column], $dir);

      if ($searchValue) {
          $query->where(function($query) use ($searchValue, $searchColumn) {
              $query->where($searchColumn, 'like', '%' . $searchValue . '%');
          });
      }

      $empleados = $query->paginate($length);
      return ['data' => $empleados, 'draw' => $request->input('draw')];
    
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Empleado $empleado)
    {
        //
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact($empleado));
    }

    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    public function destroy(Empleado $empleado)
    {
        //
    }
}
