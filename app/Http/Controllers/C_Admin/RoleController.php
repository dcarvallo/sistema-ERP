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
    
    public function index()
    {
        return view('admin.roles.index');
    }

    public function obtenerroles(Request $request)
    {
        $columns = ['name', 'description', 'special', 'ver', 'editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');
        $query = Role::select('id', 'name', 'description','special')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%');
            });
        }

        $roles = $query->paginate($length);
        return ['data' => $roles, 'draw' => $request->input('draw')];
    }

    public function create()
    {

        $permisos = Permission::all()->groupBy('category')->toArray();
        ksort($permisos);
        $cat = Role::select('category')->groupBy('category')->get();
        foreach($cat as $cate){
            $categorias[] = $cate->category;
        }
        // dd($categorias);
        // $permisos = Permission::select('id', 'name', 'description', 'category')->get()->toArray();
        
        return view('admin.roles.create', compact('permisos', 'categorias'));;
    }

    public function store(Request $request)
    {


      $this->validate($request, [
        'name' => 'required|string',
        'slug' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        ]);
        try {
          $rol = new Role();
          $rol->name = $request->name;
          $rol->slug = $request->slug;
          $rol->description = $request->description;
          $rol->category = $request->category;
          
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
            'title'   => 'Rol creado: ',
            'message' => $request->name,
          );
          
          return [$rol,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'Rol no creado: ',
            'message' => $rol->name,
          );
          return [$rol, $toast , $th];
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $rol = Role::find($id);
      $permisos = Permission::all()->groupBy('category')->toArray();
      ksort($permisos);

      $cat = Role::select('category')->groupBy('category')->get();
      foreach($cat as $cate){
          $categorias[] = $cate->category;
      }
      return view('admin.roles.edit', compact('rol', 'permisos' , 'categorias'));
    }

    public function update(Request $request, $id)
    {
        
      $this->validate($request, [
        'name' => 'required|string',
        'slug' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        ]);
        try {
          $rol = Role::find($id);
          $rol->name = $request->name;
          $rol->slug = $request->slug;
          $rol->description = $request->description;
          $rol->category = $request->category;
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
          );
          
          return [$rol,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'Rol no creado: ',
            'message' => $rol->name,
          );
          return [$rol, $toast , $th];
        }

    }

    public function destroy($id)
    {
      $rol = Role::find($id);
        $rol->delete();
        $toast = array(
          'title'   => 'Rol eliminado: ',
          'message' => '',
        );
        return $toast;
    }
}
