<?php

use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('admin'),
            'activo' => 1,
            'fotografia' => 'usuariodef/avatar.png',
        ]);
    }
}
