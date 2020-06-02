<?php

namespace App\Http\Controllers\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Log;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index');
    }

    public function obtenerroles(Request $request)
    {
        $columns = ['name', 'description', 'ver', 'editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Role::select('id', 'name', 'description')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%');
            });
        }

        $roles = $query->paginate($length);
        Log::info($roles);
        return ['data' => $roles, 'draw' => $request->input('draw')];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permisos = Permission::all()->groupBy('category')->toArray();
        ksort($permisos);
        // $permisos = Permission::select('id', 'name', 'description', 'category')->get()->toArray();
        
        return view('admin.roles.create', compact('permisos'));;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $this->validate($request, [
        'name' => 'required|string',
        'slug' => 'required|string',
        'description' => 'required|string',
        ]);
        try {
          $rol = new Role();
          $rol->name = $request->name;
          $rol->slug = $request->slug;
          $rol->description = $request->description;
          if($request->special)
          {
            $rol->special = $request->special;
          }
          
          $rol->save();


          if($request->permisos)
          {
            $array = explode(",", $request->permisos);
            $rol->givePermissionTo($array);
          }
          
          $toast = array(
            'title'   => 'rol creado: ',
            'message' => $request->name,
            'type'    => 'success'
          );
          
          return [$rol,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'rol no creado: ',
            'message' => $rol->name,
            'type'    => 'error'
          );
          return [$rol, $toast , $th];
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $rol = Role::find($id);
      $permisos = Permission::all()->groupBy('category')->toArray();
      ksort($permisos);
      return view('admin.roles.edit', compact('rol', 'permisos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
      $this->validate($request, [
        'name' => 'required|string',
        'slug' => 'required|string',
        'description' => 'required|string',
        ]);
        try {
          $rol = Role::find($id);
          $rol->name = $request->name;
          $rol->slug = $request->slug;
          Log::info($request);
          $rol->description = $request->description;
          if($request->special)
          {
            $rol->special = $request->special;
          }
          
          $rol->save();

          if($request->permisos)
          {
            $array = explode(",", $request->permisos);
            $rol->syncPermissions($array);
          }
          
          $toast = array(
            'title'   => 'Rol modificado: ',
            'message' => $request->name,
            'type'    => 'success'
          );
          
          return [$rol,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'Rol no creado: ',
            'message' => $rol->name,
            'type'    => 'error'
          );
          return [$rol, $toast , $th];
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $rol = Role::find($id);
       Log::info($rol);
        $rol->delete();
        $toast = array(
          'title'   => 'Rol eliminado: ',
          'message' => '',
          'type'    => 'success'
        );
        return $toast;
    }
}
