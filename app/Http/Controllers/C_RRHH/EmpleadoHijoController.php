<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Empleado_hijo;
use Illuminate\Http\Request;

class EmpleadoHijoController extends Controller
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
     * @param  \App\Empleado_hijo  $empleado_hijo
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado_hijo $empleado_hijo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado_hijo  $empleado_hijo
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado_hijo $empleado_hijo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado_hijo  $empleado_hijo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado_hijo $empleado_hijo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado_hijo  $empleado_hijo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado_hijo $empleado_hijo)
    {
        //
    }
}
