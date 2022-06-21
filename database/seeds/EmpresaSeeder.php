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
        'nit'               => 159753456,
        'propietario'       => 'Juan Perez',
        'mision'            => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad aliquid accusamus saepe earum temporibus nobis ipsum minus voluptas quam accusantium quaerat, eos, pariatur eveniet cumque! Aspernatur rerum nesciunt blanditiis architecto.',
        'vision'            => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor quis quasi veniam perferendis sint doloremque impedit sunt dignissimos explicabo quam!',
        'direccion'         => 'calle falsa 1234',
        'email'             => 'empresa@erp.com',
        'telefono'          => '64-12345',
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

      //crear empleado
      DB::table('empleados')->insert([
        'empleado_id'       => '111251',
        'nombres'           => 'Juan',
        'ap_paterno'        => 'Perez',
        'ap_materno'        => 'Gonzales',
        'ci'                => '1598745',
        'lugar_exp'         => 'CH',
        'fecha_nac'         => now(),
        'lugar_nac'         => 'Sucre',
        'fecha_contrato'    => now(),
        'tipo_contrato'     => 'Indefinido',
        'estado'            => 'Alta', //alta, baja
        'sexo'              => 'Hombre',
        'cargo_id'          => 1,
      ]);
    }
}
