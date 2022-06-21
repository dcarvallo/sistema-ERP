<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsuariosSeeder::class,
            PermisosTableSeeder::class,
            RoleSeederTable::class,
            ModelHasRolesTable::class,
            EmpresaSeeder::class,
        ]);
    }
}
