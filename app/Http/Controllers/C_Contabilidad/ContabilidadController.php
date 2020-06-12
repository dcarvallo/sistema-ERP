<?php

namespace App\Http\Controllers\C_Contabilidad;

use App\Models\M_Contabilidad\Contabilidad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ContabilidadController extends Controller
{
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-contabilidad'))
      {
          abort(403);
      }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Contabilidad $contabilidad)
    {
        //
    }

    public function edit(Contabilidad $contabilidad)
    {
        //
    }

    public function update(Request $request, Contabilidad $contabilidad)
    {
        //
    }

    public function destroy(Contabilidad $contabilidad)
    {
        //
    }
}
