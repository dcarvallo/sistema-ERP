<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use App\Models\M_Empresa\Empresa;
use App\Models\M_Empresa\Ubicacion;
use Illuminate\Http\Request;
use DB;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('empresa.ubicacion.index');
    }

    public function obtenerubicaciones(Request $request)
    {
        $columns = ['nombre', 'descripcion', 'locacion', 'empresa','editar', 'eliminar'];

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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.ubicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'locacion' => 'required|string'
        ]);

        $empresa = Empresa::first('id');

        // dd($empresa);

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

            return redirect('/ubicaciones')->with('mensaje', $toast);
        }
        else
        {
            $toast = array(
                'title'   => 'error',
                'message' => 'empresa no creada',
                'type'    => 'error'
            );
            return redirect('/ubicaciones')->with('mensaje', $toast);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ubicacion $ubicacion)
    {
        //
    }
}
