<?php

namespace App\Http\Controllers\C_Tesoreria;

use App\Models\M_Tesoreria\Tesoreria;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class TesoreriaController extends Controller
{
  
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-tesorerias'))
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

    public function show(Tesoreria $tesoreria)
    {
        //
    }

    public function edit(Tesoreria $tesoreria)
    {
        //
    }

    public function update(Request $request, Tesoreria $tesoreria)
    {
        //
    }

    public function destroy(Tesoreria $tesoreria)
    {
        //
    }
}
