<?php

namespace App\Http\Controllers\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{

    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-admin') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('admin.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function gestionararchivos()
    {
      if(!Auth::user()->can('permisos', 'Administrador-archivos') || Auth::user()->hasRole('Inactivo')) abort(403);

      return view('/filemanager');
    }
}
