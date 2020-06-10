<?php

namespace App\Http\Controllers\C_RRHH;

use App\Http\Controllers\Controller;
use App\Recursoshumano;
use Illuminate\Http\Request;

use App\User;

class RecursoshumanoController extends Controller
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
      if ($users = cache()->get('llave')) {
        return json_decode($users);
      }
      $users = User::all();

      cache()->put('llave', $users);

      return $users;
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
     * @param  \App\Recursoshumano  $recursoshumano
     * @return \Illuminate\Http\Response
     */
    public function show(Recursoshumano $recursoshumano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recursoshumano  $recursoshumano
     * @return \Illuminate\Http\Response
     */
    public function edit(Recursoshumano $recursoshumano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recursoshumano  $recursoshumano
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recursoshumano $recursoshumano)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recursoshumano  $recursoshumano
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recursoshumano $recursoshumano)
    {
        //
    }
}
