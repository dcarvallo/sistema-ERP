<?php

namespace Tests\Feature\Http\Controllers\C_RRHH;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Str;

class EmpleadoControllerTest extends TestCase
{
       /** @test */
       public function verifica_vista_empleados()
       {
   
         $this->actingAs(User::find(1))
               ->get('empleados')
               ->assertStatus(200)
               ->assertSee('empleado');
       }
   
       /** @test */
       public function verifica_vista_empleados_sin_empleado_autenticado()
       {
   
         $this->get('empleados')
               ->assertStatus(302)
               ->assertRedirect('/login');
       }
   
       /** @test */
       public function verifica_vista_crear_empleados()
       {
   
         $this->actingAs(User::find(1))
               ->get('empleados/create')
               ->assertStatus(200)
               ->assertSee('Crear Empleado');
       }
   
       /** @test */
       public function verifica_almacenar_empleados()
       {
         
         $response = $this->actingAs(User::find(1))
                         ->postJson(route('empleados.store'), [
                           'empleado_id' => '71234567-jpg',
                           'nombres' => 'Juan',
                            'ap_paterno' => 'Perez',
                            'ap_materno' => 'Gonzales',
                            'ci' => '71234567',
                            'fecha_nac' => now()->format('Y-m-d'),
                            'lugar_nac' => 'sefsef',
                            'sexo' => 'Hombre',
                            'fecha_contrato' => now()->format('Y-m-d'),
                            'tipo_contrato' => 'Indefinido',
                            'nacionalidad' => 'sefsef',
                            'direccion' => 'sefsef',
                            'lugar_exp' => 'sefsef',
                            'cargo_id' => 1,
                         ]);
   
           $response->assertStatus(200);
           $response->assertSee('empleado creado');
       }
   
       /** @test */
       public function verifica_vista_ver_empleado()
       {
   
         $this->actingAs(User::find(1))
               ->get('/empleados/1')
               ->assertStatus(200)
               ->assertSee('mostrarempleado');
       }
   
       /** @test */
       public function verifica_vista_editar_empleados()
       {
   
         $this->actingAs(User::find(1))
               ->get('empleados/1/edit')
               ->assertStatus(200)
               ->assertSee('editarempleado');
       }
}
