<?php

use Illuminate\Database\Seeder;

class RoleSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'          => 'Super Admin',
            'guard_name'    => 'Acceso super administrador',
            'description'   => 'Acceso a todos los modulo del sistema',
            'category'      => 'Admin'
        ]);

        DB::table('roles')->insert([
          'name'          => 'Inactivo',
          'guard_name'    => 'Ningun acceso',
          'description'   => 'Acceso a ningun modulo del sistema',
          'category'      => 'Inactivo'
      ]);
    }
}
