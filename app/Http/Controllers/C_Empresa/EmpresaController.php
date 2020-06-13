<?php

namespace App\Http\Controllers\C_Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\M_Empresa\Empresa;
use Auth;

use Illuminate\Support\Facades\Storage;

use File;

class EmpresaController extends Controller
{
  
    public function index()
    {
      if(!Auth::user()->can('permisos', 'Navegar-empresas'))
      {
          abort(403);
      }
        $empresa = Empresa::first();
        return view('empresa.empresa.index', compact('empresa'));
      
    }

    public function create()
    {
      if(!Auth::user()->can('permisos', 'Crear-empresas'))
      {
          abort(403);
      }
        return view('empresa.empresa.create');
      
    }

    public function store(Request $request)
    {
      if(!Auth::user()->can('permisos', 'Crear-empresas'))
      {
          abort(403);
      }
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
      if(!Auth::user()->can('permisos', 'Ver-empresas'))
      {
          abort(403);
      }

    }

    public function edit(Empresa $empresa)
    {
      if(!Auth::user()->can('permisos', 'Editar-empresas'))
      {
          abort(403);
      }
        return view('empresa.empresa.edit', compact('empresa'));
      
    }

    public function update(Request $request, Empresa $empresa)
    {
      if(!Auth::user()->can('permisos', 'Editar-empresas'))
      {
          abort(403);
      }
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

        cache()->flush('datos-empresa');

        return redirect('/empresas')->with('toast', $empresa->nombre.': Informacion modificada');
    }

    public function destroy(Empresa $empresa)
    {
      if(!Auth::user()->can('permisos', 'Eliminar-empresas'))
      {
          abort(403);
      }
    }
}
