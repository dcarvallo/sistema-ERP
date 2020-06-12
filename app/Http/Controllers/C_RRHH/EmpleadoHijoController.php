<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Empleado_hijo;
use Illuminate\Http\Request;

class EmpleadoHijoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Empleado_hijo $empleado_hijo)
    {
        //
    }

    public function edit(Empleado_hijo $empleado_hijo)
    {
        //
    }

    public function update(Request $request, Empleado_hijo $empleado_hijo)
    {
        //
    }

    public function destroy(Empleado_hijo $empleado_hijo)
    {
        //
    }
}
