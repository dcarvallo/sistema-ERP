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
            'name'          => 'Admin',
            'slug'          => 'admin',
            'description'   => 'Acceso a todos los modulo del sistema',
            'special'       => 'all-access'
        ]);
    }
}
