<?php

namespace App\Http\Controllers\C_Almacen;

use App\Models\M_Almacen\Almacen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AlmacenController extends Controller
{
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-almacen') || Auth::user()->hasRole('Inactivo')) abort(403);
      
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Almacen $almacen)
    {
        //
    }

    public function edit(Almacen $almacen)
    {
        //
    }

    public function update(Request $request, Almacen $almacen)
    {
        //
    }

    public function destroy(Almacen $almacen)
    {
        //
    }
}
