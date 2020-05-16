<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_Empresa\Empresa;

class EmpresaController extends Controller
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
        $empresa = Empresa::first();
        return view('empresa.empresa.index', compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.empresa.create');
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
            'rubro' => 'required|string',
            'direccion' => 'required|string',
            'fecha_creacion' => 'required',
        ]);

        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->descripcion = $request->descripcion;
        $empresa->rubro = $request->rubro;
        $empresa->mision = $request->mision;
        $empresa->vision = $request->vision;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        $empresa->fecha_creacion = $request->fecha_creacion;
        $empresa->save();

        // return response()->json(null, 200);

        return $empresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
