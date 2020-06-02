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
            'description'   => 'Lista y navega todos los usuarios de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de usuarios',
            'slug'          => 'users.show',
            'description'   => 'Ver en detalle usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de usuario',
            'slug'          => 'users.edit',
            'description'   => 'Editar cualquier dato de un usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Eliminar cuaquier usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear usuarios',
            'slug'          => 'users.create',
            'description'   => 'Crear usuario de la empresa',
            'category'      => 'Usuarios'
        ]);

        //roles

        DB::table('permissions')->insert([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de roles',
            'slug'          => 'roles.show',
            'description'   => 'Ver en detalle rol',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier dato de un rol de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Eliminar cuaquier rol de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear roles',
            'slug'          => 'roles.create',
            'description'   => 'Crea roles de la empresa',
            'category'      => 'Roles'
        ]);

        //permisos

        DB::table('permissions')->insert([
          'name'          => 'Navegar permisos',
          'slug'          => 'permisos.index',
          'description'   => 'Lista y navega todos los permisos de la empresa',
          'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de permiso',
            'slug'          => 'permisos.show',
            'description'   => 'Ver en detalle cada permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de permisos',
            'slug'          => 'permisos.edit',
            'description'   => 'Editar cualquier dato de un permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar permiso',
            'slug'          => 'permisos.destroy',
            'description'   => 'Eliminar cuaquier permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear permmiso',
            'slug'          => 'permisos.create',
            'description'   => 'Crea permisos de la empresa',
            'category'      => 'Permisos'
        ]);

        //Empresa

        DB::table('permissions')->insert([
            'name'          => 'Navegar empresas',
            'slug'          => 'empresas.index',
            'description'   => 'Lista y navega todos los empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de empresas',
            'slug'          => 'empresas.show',
            'description'   => 'Ver en detalle cada empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de empresas',
            'slug'          => 'empresas.edit',
            'description'   => 'Editar cualquier dato de una empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar empresas',
            'slug'          => 'empresas.destroy',
            'description'   => 'Eliminar cuaquier empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear empresas',
            'slug'          => 'empresas.create',
            'description'   => 'Crea empresa de la empresa',
            'category'      => 'Empresas'
        ]);

        //Ubicacion

        DB::table('permissions')->insert([
            'name'          => 'Navegar ubicaciones',
            'slug'          => 'ubicaciones.index',
            'description'   => 'Lista y navega todos los ubicaciones de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'ver detalle de ubicaciones',
            'slug'          => 'ubicaciones.show',
            'description'   => 'Ver en detalle cada ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de ubicaciones',
            'slug'          => 'ubicaciones.edit',
            'description'   => 'Editar cualquier dato de una ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar ubicaciones',
            'slug'          => 'ubicaciones.destroy',
            'description'   => 'Eliminar cuaquier ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear ubicaciones',
            'slug'          => 'ubicaciones.create',
            'description'   => 'Crear ubicaciones de la empresa',
            'category'      => 'Ubicaciones'
        ]);

        //Departamento

        DB::table('permissions')->insert([
            'name'          => 'Navegar departamentos',
            'slug'          => 'departamentos.index',
            'description'   => 'Lista y navega todos los departamentos de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de departamentos',
            'slug'          => 'departamentos.show',
            'description'   => 'Ver en detalle cada departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de departamentos',
            'slug'          => 'departamentos.edit',
            'description'   => 'Editar cualquier dato de un departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar departamentos',
            'slug'          => 'departamentos.destroy',
            'description'   => 'Eliminar cuaquier departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear departamentos',
            'slug'          => 'departamentos.create',
            'description'   => 'Crea  departamentos de la empresa',
            'category'      => 'Departamentos'
        ]);

        //Area

        DB::table('permissions')->insert([
            'name'          => 'Navegar áreas',
            'slug'          => 'areas.index',
            'description'   => 'Lista y navega todos los áreas de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de áreas',
            'slug'          => 'areas.show',
            'description'   => 'Ver en detalle cada área de la empresa',
            'category'      => 'Areas' 
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de areas',
            'slug'          => 'areas.edit',
            'description'   => 'Editar cualquier dato de un área de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar areas',
            'slug'          => 'areas.destroy',
            'description'   => 'Eliminar cuaquier área de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear áreas',
            'slug'          => 'areas.create',
            'description'   => 'Crea áreas de la empresa',
            'category'      => 'Areas'
        ]);

        //Cargos

        DB::table('permissions')->insert([
            'name'          => 'Navegar cargos',
            'slug'          => 'cargos.index',
            'description'   => 'Lista y navega todos los cargos del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de cargos',
            'slug'          => 'cargos.show',
            'description'   => 'Ver en detalle cada area del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de cargos',
            'slug'          => 'cargos.edit',
            'description'   => 'Editar cualquier dato de un cargo del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar cargos',
            'slug'          => 'cargos.destroy',
            'description'   => 'Eliminar cuaquier cargo del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear cargos',
            'slug'          => 'cargos.create',
            'description'   => 'Crea los cargos de la empresa',
            'category'      => 'Cargos'
        ]);

        //Empleado

        DB::table('permissions')->insert([
            'name'          => 'Navegar empleados',
            'slug'          => 'empleados.index',
            'description'   => 'Lista y navega todos los empleados de la mepresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver detalle de empleados',
            'slug'          => 'empleados.show',
            'description'   => 'Ver en detalle cada empleados de la empresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Edición de empleados',
            'slug'          => 'empleados.edit',
            'description'   => 'Editar cualquier dato de una empleados de la empresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar empleados',
            'slug'          => 'empleados.destroy',
            'description'   => 'Eliminar cuaquier empleados de la emprsea',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear empleados',
            'slug'          => 'empleados.create',
            'description'   => 'Crear empleados de la empresa',
            'category'      => 'Empleados'
        ]);


    }
}
