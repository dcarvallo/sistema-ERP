<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{


    public function index()
    {
        return view('rrhh.empleados.index');
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
