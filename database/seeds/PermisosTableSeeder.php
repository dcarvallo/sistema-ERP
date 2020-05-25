<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\permissions;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuarios

        DB::table('permissions')->insert([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
            'category'      => 'usuario'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de usuarios',
            'slug'          => 'users.show',
            'description'   => 'Ver en detalle cada usuarios del sistema',
            'category'      => 'usuario'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Editar cualquier dato de un usuario del sistema',
            'category'      => 'usuario'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar usuarios',
            'slug'          => 'users.destroy',
            'description'   => 'Eliminar cuaquier usuarios del sistema',
            'category'      => 'usuario'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear usuarios',
            'slug'          => 'users.create',
            'description'   => 'Lista y navega todos los usuarios del sistema',
            'category'      => 'usuario'
        ]);

        //roles

        DB::table('permissions')->insert([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
            'category'      => 'rol'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de roles',
            'slug'          => 'roles.show',
            'description'   => 'Ver en detalle cada roles del sistema',
            'category'      => 'rol'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier dato de un rol del sistema',
            'category'      => 'rol'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Eliminar cuaquier roles del sistema',
            'category'      => 'rol'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear roles',
            'slug'          => 'roles.create',
            'description'   => 'Lista y navega todos los roles del sistema',
            'category'      => 'rol'
        ]);

        //Empresa

        DB::table('permissions')->insert([
            'name'          => 'Navegar empresas',
            'slug'          => 'empresas.index',
            'description'   => 'Lista y navega todos los empresas del sistema',
            'category'      => 'empresa'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de empresas',
            'slug'          => 'empresas.show',
            'description'   => 'Ver en detalle cada empresas del sistema',
            'category'      => 'empresa'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de empresas',
            'slug'          => 'empresas.edit',
            'description'   => 'Editar cualquier dato de una empresas del sistema',
            'category'      => 'empresa'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar empresas',
            'slug'          => 'empresas.destroy',
            'description'   => 'Eliminar cuaquier empresas del sistema',
            'category'      => 'empresa'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear empresas',
            'slug'          => 'empresas.create',
            'description'   => 'Lista y navega todos los empresas del sistema',
            'category'      => 'empresa'
        ]);

        //Ubicacion

        DB::table('permissions')->insert([
            'name'          => 'Navegar ubicaciones',
            'slug'          => 'ubicaciones.index',
            'description'   => 'Lista y navega todos los ubicaciones del sistema',
            'category'      => 'ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de ubicaciones',
            'slug'          => 'ubicaciones.show',
            'description'   => 'Ver en detalle cada ubicacion del sistema',
            'category'      => 'ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de ubicaciones',
            'slug'          => 'ubicaciones.edit',
            'description'   => 'Editar cualquier dato de una ubicacion del sistema',
            'category'      => 'ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar ubicaciones',
            'slug'          => 'ubicaciones.destroy',
            'description'   => 'Eliminar cuaquier ubicacion del sistema',
            'category'      => 'ubicacion'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear ubicaciones',
            'slug'          => 'ubicaciones.create',
            'description'   => 'Lista y navega todos los ubicaciones del sistema',
            'category'      => 'ubicacion'
        ]);

        //Departamento

        DB::table('permissions')->insert([
            'name'          => 'Navegar departamentos',
            'slug'          => 'departamentos.index',
            'description'   => 'Lista y navega todos los departamentos del sistema',
            'category'      => 'departamento'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de departamentos',
            'slug'          => 'departamentos.show',
            'description'   => 'Ver en detalle cada departamento del sistema',
            'category'      => 'departamento'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de departamentos',
            'slug'          => 'departamentos.edit',
            'description'   => 'Editar cualquier dato de un departamento del sistema',
            'category'      => 'departamento'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar departamentos',
            'slug'          => 'departamentos.destroy',
            'description'   => 'Eliminar cuaquier departamento del sistema',
            'category'      => 'departamento'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear departamentos',
            'slug'          => 'departamentos.create',
            'description'   => 'Lista y navega todos los departamentos del sistema',
            'category'      => 'departamento'
        ]);

        //Area

        DB::table('permissions')->insert([
            'name'          => 'Navegar areas',
            'slug'          => 'areas.index',
            'description'   => 'Lista y navega todos los areas del sistema',
            'category'      => 'area'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de areas',
            'slug'          => 'areas.show',
            'description'   => 'Ver en detalle cada area del sistema',
            'category'      => 'area'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de areas',
            'slug'          => 'areas.edit',
            'description'   => 'Editar cualquier dato de una area del sistema',
            'category'      => 'area'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar areas',
            'slug'          => 'areas.destroy',
            'description'   => 'Eliminar cuaquier area del sistema',
            'category'      => 'area'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear areas',
            'slug'          => 'areas.create',
            'description'   => 'Lista y navega todos los areas del sistema',
            'category'      => 'area'
        ]);

        //Area

        DB::table('permissions')->insert([
            'name'          => 'Navegar cargos',
            'slug'          => 'cargos.index',
            'description'   => 'Lista y navega todos los cargos del sistema',
            'category'      => 'cargo'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de cargos',
            'slug'          => 'cargos.show',
            'description'   => 'Ver en detalle cada area del sistema',
            'category'      => 'cargo'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de cargos',
            'slug'          => 'cargos.edit',
            'description'   => 'Editar cualquier dato de un cargo del sistema',
            'category'      => 'cargo'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar cargos',
            'slug'          => 'cargos.destroy',
            'description'   => 'Eliminar cuaquier cargo del sistema',
            'category'      => 'cargo'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear cargos',
            'slug'          => 'cargos.create',
            'description'   => 'Lista y navega todos los cargos del sistema',
            'category'      => 'cargo'
        ]);

        //Empleado

        DB::table('permissions')->insert([
            'name'          => 'Navegar empleados',
            'slug'          => 'empleados.index',
            'description'   => 'Lista y navega todos los empleados del sistema',
            'category'      => 'empleado'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de empleados',
            'slug'          => 'empleados.show',
            'description'   => 'Ver en detalle cada empleados del sistema',
            'category'      => 'empleado'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de empleados',
            'slug'          => 'empleados.edit',
            'description'   => 'Editar cualquier dato de una empleados del sistema',
            'category'      => 'empleado'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar empleados',
            'slug'          => 'empleados.destroy',
            'description'   => 'Eliminar cuaquier empleados del sistema',
            'category'      => 'empleado'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear empleados',
            'slug'          => 'empleados.create',
            'description'   => 'Lista y navega todos los empleados del sistema',
            'category'      => 'empleado'
        ]);


    }
}
