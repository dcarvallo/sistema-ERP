<?php

use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //crear empresa
      DB::table('empresas')->insert([
        'nombre'            => 'Sistema ERP',
        'descripcion'       => 'Descripcion empresa',
        'rubro'             => 'Tecnologia',
        'fecha_creacion'    => now()
      ]);

      //crear ubicacion
      DB::table('ubicaciones')->insert([
        'nombre'            => 'Ubicacion 1',
        'descripcion'       => 'Descripcion de ubicacion 1',
        'locacion'          => 'calle falsa 123',
        'empresa_id'    => 1
      ]);

      //crear departamento
      DB::table('departamentos')->insert([
        'nombre'            => 'Departamento 1',
        'descripcion'       => 'Descripcion de departamento 1',
        'ubicacion_id'      => 1
      ]);

      //crear area
      DB::table('areas')->insert([
        'nombre'            => 'Area 1',
        'descripcion'       => 'Descripcion de Area 1',
        'departamento_id'   => 1
      ]);

      //crear cargo
      DB::table('cargos')->insert([
        'nombre'            => 'Cargo 1',
        'descripcion'       => 'Descripcion de cargo 1',
        'area_id'           => 1
      ]);
    }
}
