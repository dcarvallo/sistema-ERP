<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Empleado_familiar;
use Illuminate\Http\Request;

class EmpleadoFamiliarController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado_familiar  $empleado_familiar
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado_familiar $empleado_familiar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado_familiar  $empleado_familiar
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado_familiar $empleado_familiar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado_familiar  $empleado_familiar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado_familiar $empleado_familiar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado_familiar  $empleado_familiar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado_familiar $empleado_familiar)
    {
        //
    }
}
