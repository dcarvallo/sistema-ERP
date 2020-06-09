<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_Empresa\Empresa;

use Illuminate\Support\Facades\Storage;

use File;
use Log;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $empresa = Empresa::first();
        return view('empresa.empresa.index', compact('empresa'));
    }

    public function create()
    {
        return view('empresa.empresa.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'rubro' => 'required|string',
            'email' => 'email|string|nullable',
            'direccion' => 'required|string',
            'fecha_creacion' => 'required',
        ]);

        $empresa = new Empresa();
        $empresa->nombre = $request->nombre;
        $empresa->descripcion = $request->descripcion;
        $empresa->rubro = $request->rubro;
        $empresa->mision = $request->mision;
        $empresa->vision = $request->vision;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        if($request->imagen_empresa)
        {
          $ext = $request->imagen_empresa->getClientOriginalExtension();
          $fileName = str_random().'.'.$ext;
          $request->imagen_empresa->storeAs('archivos/empresa/', $fileName);
          $empresa->imagen_empresa = 'archivos/empresa/'.$fileName;

        }
        $empresa->fecha_creacion = $request->fecha_creacion;
        
        $empresa->save();

        return redirect('/empresas')->with('toast', $empresa->nombre.': Empresa creada');
    }

    public function show(Empresa $empresa)
    {
        //
    }

    public function edit(Empresa $empresa)
    {
        return view('empresa.empresa.edit', compact('empresa'));
    }

    public function update(Request $request, Empresa $empresa)
    {
        $this->validate($request, [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'rubro' => 'required|string',
            'email' => 'email|string',
            'direccion' => 'required|string',
            'fecha_creacion' => 'required',
        ]);

        $empresa->nombre = $request->nombre;
        $empresa->descripcion = $request->descripcion;
        $empresa->rubro = $request->rubro;
        $empresa->mision = $request->mision;
        $empresa->vision = $request->vision;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->email = $request->email;
        if($request->imagen_empresa)
        {
            $ext = $request->imagen_empresa->getClientOriginalExtension();
            $fileName = str_random().'.'.$ext;
            $request->imagen_empresa->storeAs('archivos/empresa/', $fileName);
            $empresa->imagen_empresa = 'archivos/empresa/'.$fileName;

        }
        $empresa->fecha_creacion = $request->fecha_creacion;
        
        $empresa->save();

        return redirect('/empresas')->with('toast', $empresa->nombre.': Informacion modificada');
    }

    public function destroy(Empresa $empresa)
    {
        //
    }
}
