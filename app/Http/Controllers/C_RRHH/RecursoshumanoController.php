<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Recursoshumano;
use Illuminate\Http\Request;
use Auth;
use App\User;

class RecursoshumanoController extends Controller
{

    public function index()
    {
      
      if(!Auth::user()->can('permisos', 'Navegar-rrhh') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('rrhh.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Recursoshumano $recursoshumano)
    {
        //
    }

    public function edit(Recursoshumano $recursoshumano)
    {
        //
    }

    public function update(Request $request, Recursoshumano $recursoshumano)
    {
        //
    }

    public function destroy(Recursoshumano $recursoshumano)
    {
        //
    }
}
