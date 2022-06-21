<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Models\M_RRHH\Empleado;
use App\Models\M_Empresa\Cargo;
use Illuminate\Http\Request;
use Auth;
use App\Bitacora;
use App\Http\Requests\Empleados\StoreEmpleado;
use App\Http\Requests\Empleados\UpdateEmpleado;

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

      $columns = ['empleado_id', 'nombres', 'ap_paterno', 'ap_materno','ci', 'tipo_contrato', 'fecha_contrato', 'estado'];
      
      $length = $request->input('length');
      $column = $request->input('column');
      $dir = $request->input('dir');
      $searchValue = $request->input('search');
      $searchColumn = $request->input('searchColumn');
      
      $query = Empleado::select('id', 'empleado_id', 'nombres', 'ap_paterno', 'ap_materno','ci', 'lugar_exp','tipo_contrato', 'fecha_contrato', 'estado','cargo_id')->with('Cargo')->orderBy($columns[$column], $dir);

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
      if (!Auth::user()->can('permisos', 'Crear-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
      $cargos = Cargo::select('id', 'nombre')->get();
      return view('rrhh.empleados.create', compact('cargos'));
    }
  
    public function store(StoreEmpleado $request)
    {
      if (!Auth::user()->can('permisos', 'Crear-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
      try {
        $empleado = new Empleado();
        $empleado->empleado_id = $request->empleado_id;
        $empleado->nombres = $request->nombres;
        $empleado->ap_paterno = $request->ap_paterno;
        $empleado->ap_materno = $request->ap_materno;
        $empleado->ci = $request->ci;
        $empleado->nacionalidad = $request->nacionalidad;
        $empleado->lugar_exp = $request->lugar_exp;
        $empleado->direccion = $request->direccion;
        $empleado->fecha_nac = $request->fecha_nac;
        $empleado->lugar_nac = $request->lugar_nac;
        $empleado->sexo = $request->sexo;
        $empleado->estado_civil = $request->estado_civil;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;
        $empleado->religion = $request->religion;
        $empleado->altura = $request->altura;
        $empleado->peso = $request->peso;
        $empleado->tipo_sangre = $request->tipo_sangre;
        $empleado->fotografia = $request->fotografia;
        $empleado->fecha_contrato = $request->fecha_contrato;
        $empleado->tipo_contrato = $request->tipo_contrato;
        $empleado->cargo_id = (int)$request->cargo_id;
        
        $empleado->save();

        $bitacora = new Bitacora();
        $bitacora->mensaje = 'Se creó el empleado';
        $bitacora->registro_id = $empleado->id;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->save();
        
  
        $toast = array(
          'title'   => 'empleado creado: ',
          'message' => $request->nombres,
          'background' => '#e1f6d0',
          'type'    => 'success'
        );
        return [$empleado, $toast];

      } catch (\Illuminate\Database\QueryException $e) {
        $toast = array(
          'title'   => 'empleado no creado: ',
          'message' => $e->errorInfo,
          'type'    => 'error',
          'background' => '#edc3c3'
        );
        return [$empleado, $toast, $e->errorInfo];
      }
    }
  
    public function show($id)
    {
      if (!Auth::user()->can('permisos', 'Ver-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);

      $empleado = Empleado::where('id',$id)->with('cargo')->first();
      // dd($empleado);
      return view('rrhh.empleados.show', compact('empleado'));
    }
  
    public function edit($id)
    {
      if (!Auth::user()->can('permisos', 'Editar-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
      $cargos = Cargo::select('id', 'nombre')->get();
      $empleado = Empleado::find($id);
      return view('rrhh.empleados.edit', compact('cargos', 'empleado'));
    }
  
    public function update(UpdateEmpleado $request, $id)
    {
      if (!Auth::user()->can('permisos', 'Editar-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
      try {
        $empleado = Empleado::find($id);
        $empleado->empleado_id = $request->empleado_id;
        $empleado->nombres = $request->nombres;
        $empleado->ap_paterno = $request->ap_paterno;
        $empleado->ap_materno = $request->ap_materno;
        $empleado->ci = $request->ci;
        $empleado->nacionalidad = $request->nacionalidad;
        $empleado->lugar_exp = $request->lugar_exp;
        $empleado->direccion = $request->direccion;
        $empleado->fecha_nac = $request->fecha_nac;
        $empleado->lugar_nac = $request->lugar_nac;
        $empleado->sexo = $request->sexo;
        $empleado->estado_civil = $request->estado_civil;
        $empleado->telefono = $request->telefono;
        $empleado->email = $request->email;
        $empleado->religion = $request->religion;
        $empleado->altura = $request->altura;
        $empleado->peso = $request->peso;
        $empleado->tipo_sangre = $request->tipo_sangre;
        $empleado->fotografia = $request->fotografia;
        $empleado->fecha_contrato = $request->fecha_contrato;
        $empleado->tipo_contrato = $request->tipo_contrato;
        $empleado->cargo_id = (int)$request->cargo_id;
        $empleado->estado = $request->estado;
        
        $empleado->save();

        $bitacora = new Bitacora();
        $bitacora->mensaje = 'Se editó el empleado';
        $bitacora->registro_id = $empleado->id;
        $bitacora->user_id = Auth::user()->id;
        $bitacora->save();
        
  
        $toast = array(
          'title'   => 'empleado modificado: ',
          'message' => $request->ap_paterno,
          'background' => '#e1f6d0',
          'type'    => 'success'
        );
        return [$empleado, $toast];

      } catch (\Illuminate\Database\QueryException $e) {
        $toast = array(
          'title'   => 'empleado no modificado: ',
          'message' => $e->errorInfo,
          'type'    => 'error',
          'background' => '#edc3c3'
        );
        return [$empleado, $toast, $e->errorInfo];
      }
    }
  
  
    public function destroy($id)
    {
      if (!Auth::user()->can('permisos', 'Eliminar-empleados') || Auth::user()->hasRole('Inactivo')) abort(403);
  
      $empleado = Empleado::find($id);
      $empleado->delete();
  
      $bitacora = new Bitacora();
      $bitacora->mensaje = 'Se eliminó el empleado';
      $bitacora->registro_id = $empleado->id;
      $bitacora->user_id = Auth::user()->id;
      $bitacora->save();
  
      $toast = array(
        'title'   => 'empleado quitado. ',
        'background' => '#e1f6d0',
        'type' => 'success',
        'message' => '',
      );
      return $toast;
    }
  
    public function exportar(Request $request){
      logger($request);
      if($request->exportar == "pdf")
      {
        if($request->exportarpagina == "actual")
        {
          $datos = User::select('id','name','username','email','activo')->with('roles')->paginate();
          $datos->chunk(5);
          return PDF::loadView('empleados.exportar', compact('datos'))->download('exportado.pdf');
        }
        if($request->exportarpagina == "todo")
        {
          $datos = User::select('id','name','username','email','activo')->with('roles')->get();
          $datos->chunk(1000);
          return PDF::loadView('empleados.exportar', compact('datos'))->download('exportado.pdf');
        }
  
      }
  
      if($request->exportar == "excel")
      {
        if($request->exportarpagina == "actual")
        {
          $empleados = User::paginate();
          $vista = (string) "empleados.exportar";
           return Excel::download(new DatosExport($vista,$empleados), 'exportado.xlsx');
        }
        if($request->exportarpagina == "todo")
        {
          return (new datosallExport)->download('exportado.xlsx');
        }
      }
  
    }
}
