<?php

namespace App\Http\Controllers\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;
use Log;
use DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permisos.index');
    }

    public function obtenerpermisos(Request $request)
    {
        $columns = ['category','name', 'slug','description','ver', 'editar', 'eliminar'];

        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Permission::select('id', 'name', 'slug','description','category')->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('category', 'like', '%' . $searchValue . '%')
                ->orWhere('description', 'like', '%' . $searchValue . '%');
            });
        }

        $permisos = $query->paginate($length);
        return ['data' => $permisos, 'draw' => $request->input('draw')];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $permisos = Permission::orderBy('name', 'asc')->get();
        return view('admin.permisos.create', compact('permisos'));;
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
        'name' => 'required|string, nombre',
        'slug' => 'required|string, slug',
        'description' => 'required|string, descripcion',
        'category' => 'required|string, categoria',
        ]);
        try {
          $permiso = new Permission();
          $permiso->name = $request->name;
          $permiso->slug = $request->slug;
          $permiso->description = $request->description;
          $permiso->category = $request->category;
         
          $permiso->save();

          $toast = array(
            'title'   => 'permiso creado: ',
            'message' => $request->name,
            'type'    => 'success'
          );
          
          return [$permiso,$toast];
          
        } catch (\Throwable $th) {
          $toast = array(
            'title'   => 'permiso no creado: ',
            'message' => $permiso->name,
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
      $permiso = Permission::find($id);
      return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, $id)
    {
        
      $this->validate($request, [
        'name' => 'required|string',
        'description' => 'required|string',
        'category' => 'required|string',
        ]);
        try {
          $permiso = Permission::find($id);
          $permiso->name = $request->name;
          $permiso->description = $request->description;
          $permiso->category = $request->category;
          
          $permiso->save();
          
          $toast = array(
            'title'   => 'permiso modificado: ',
            'message' => $request->name,
            'type'    => 'success'
          );
          
          return [$permiso,$toast];
          
        // } catch (\Throwable $th) {
        } catch (\Illuminate\Database\QueryException $e) {
          Log::info($e->errorInfo);

          $toast = array(
            'title'   => 'permiso no modificado: ',
            'message' => $e->errorInfo,
            'type'    => 'error'
          );
          return [$request,$toast,$e->errorInfo];
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
      $permiso = Permission::find($id);
        $permiso->delete();
        $toast = array(
          'title'   => 'permiso eliminado: ',
          'message' => '',
          'type'    => 'success'
        );
        return $toast;
    }
}
