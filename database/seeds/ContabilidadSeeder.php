<?php

use Illuminate\Database\Seeder;

class ContabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tipoasientos')->insert([
        'nombre'            => 'Apunte',
        'descripcion'       => 'Apunte'
      ]);
    }
}
