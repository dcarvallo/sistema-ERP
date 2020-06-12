<?php

use Illuminate\Database\Seeder;

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
          'name'          => 'Navegar-admin',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos dashborad admin',
          'category'      => 'Admin'
        ]);

        DB::table('permissions')->insert([
          'name'          => 'Administrador-archivos',
          'guard_name'    => 'web',
          'description'   => 'Administra archivos subidos en carpeta publica',
          'category'      => 'Admin'
        ]);

        DB::table('permissions')->insert([
            'name'          => 'Navegar-usuarios',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los usuarios de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-usuarios',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-usuarios',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-usuarios',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier usuario de la empresa',
            'category'      => 'Usuarios'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-usuarios',
            'guard_name'    => 'web',
            'description'   => 'Crear usuario de la empresa',
            'category'      => 'Usuarios'
        ]);

        //roles

        DB::table('permissions')->insert([
            'name'          => 'Navegar-roles',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los roles de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-roles',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle rol',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-roles',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un rol de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-roles',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier rol de la empresa',
            'category'      => 'Roles'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-roles',
            'guard_name'    => 'web',
            'description'   => 'Crea rol de la empresa',
            'category'      => 'Roles'
        ]);

        //permisos

        DB::table('permissions')->insert([
          'name'          => 'Navegar-permisos',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos los permisos de la empresa',
          'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-permisos',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle de permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-permisos',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-permisos',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier permiso de la empresa',
            'category'      => 'Permisos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-permmisos',
            'guard_name'    => 'web',
            'description'   => 'Crea permisos de la empresa',
            'category'      => 'Permisos'
        ]);

        //Empresa

        DB::table('permissions')->insert([
            'name'          => 'Navegar-empresas',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-empresas',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-empresas',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de una empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-empresas',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier empresas de la empresa',
            'category'      => 'Empresas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-empresas',
            'guard_name'    => 'web',
            'description'   => 'Crea empresa de la empresa',
            'category'      => 'Empresas'
        ]);

        //Ubicacion

        DB::table('permissions')->insert([
            'name'          => 'Navegar-ubicaciones',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los ubicaciones de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-ubicaciones',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-ubicaciones',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de una ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-ubicaciones',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier ubicacion de la empresa',
            'category'      => 'Ubicaciones'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-ubicaciones',
            'guard_name'    => 'web',
            'description'   => 'Crear ubicaciones de la empresa',
            'category'      => 'Ubicaciones'
        ]);

        //Departamento

        DB::table('permissions')->insert([
            'name'          => 'Navegar-departamentos',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los departamentos de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-departamentos',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-departamentos',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-departamentos',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier departamento de la empresa',
            'category'      => 'Departamentos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-departamentos',
            'guard_name'    => 'web',
            'description'   => 'Crea departamentos de la empresa',
            'category'      => 'Departamentos'
        ]);

        //Area

        DB::table('permissions')->insert([
            'name'          => 'Navegar-areas',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los áreas de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-areas',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada área de la empresa',
            'category'      => 'Areas' 
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-areas',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un área de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-areas',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier área de la empresa',
            'category'      => 'Areas'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-areas',
            'guard_name'    => 'web',
            'description'   => 'Crea áreas de la empresa',
            'category'      => 'Areas'
        ]);

        //Cargos

        DB::table('permissions')->insert([
            'name'          => 'Navegar-cargos',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los cargos del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-cargos',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada area del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-cargos',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de un cargo del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-cargos',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier cargo del sistema',
            'category'      => 'Cargos'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-cargos',
            'guard_name'    => 'web',
            'description'   => 'Crea los cargos de la empresa',
            'category'      => 'Cargos'
        ]);

        //Empleado

        DB::table('permissions')->insert([
            'name'          => 'Navegar-empleados',
            'guard_name'    => 'web',
            'description'   => 'Lista y navega todos los empleados de la empresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Ver-empleados',
            'guard_name'    => 'web',
            'description'   => 'Ver en detalle cada empleados de la empresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Editar-empleados',
            'guard_name'    => 'web',
            'description'   => 'Editar cualquier dato de una empleados de la empresa',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Eliminar-empleados',
            'guard_name'    => 'web',
            'description'   => 'Eliminar cuaquier empleados de la emprsea',
            'category'      => 'Empleados'
        ]);
        DB::table('permissions')->insert([
            'name'          => 'Crear-empleados',
            'guard_name'    => 'web',
            'description'   => 'Crear empleados de la empresa',
            'category'      => 'Empleados'
        ]);


        //Tesoreria

        DB::table('permissions')->insert([
          'name'          => 'Navegar-tesoreria',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos los modulos de la tesoreria',
          'category'      => 'Tesoreria'
        ]);

        //Contabilidad

        DB::table('permissions')->insert([
          'name'          => 'Navegar-contabilidad',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos los modulos de contabilidad',
          'category'      => 'Contabilidad'
        ]);

        //Almacenes

        DB::table('permissions')->insert([
          'name'          => 'Navegar-almacen',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos los modulos de contabilidad',
          'category'      => 'Almacen'
        ]);

        //Helpdesk

        DB::table('permissions')->insert([
          'name'          => 'Navegar-helpdesk',
          'guard_name'    => 'web',
          'description'   => 'Lista y navega todos los modulos de helpdesk',
          'category'      => 'Helpdesk'
        ]);

    }
}
