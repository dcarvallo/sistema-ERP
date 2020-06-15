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
            'guard_name'    => 'web',
            'description'   => 'Acceso a todos los modulo del sistema',
            'category'      => 'Admin'
        ]);
        DB::table('roles')->insert([
          'name'          => 'Inactivo',
          'guard_name'    => 'web',
          'description'   => 'Sin acceso',
          'category'      => 'Inactivo'
      ]);
    }
}
