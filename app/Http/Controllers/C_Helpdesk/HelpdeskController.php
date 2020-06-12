<?php

namespace App\Http\Controllers\C_Helpdesk;

use App\Models\M_Helpdesk\Helpdesk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HelpdeskController extends Controller
{

    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-helpdesk'))
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

    public function show(Helpdesk $helpdesk)
    {
        //
    }

    public function edit(Helpdesk $helpdesk)
    {
        //
    }

    public function update(Request $request, Helpdesk $helpdesk)
    {
        //
    }

    public function destroy(Helpdesk $helpdesk)
    {
        //
    }
}
