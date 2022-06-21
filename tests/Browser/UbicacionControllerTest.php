<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class UbicacionControllerTest extends DuskTestCase
{
     /** @test */
     public function vista_de_ubicaciones()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('ubicaciones')
                 ->type('username', 'admin')
                 ->type('password', 'admin')
                 ->press('Ingresar')
                 ->assertSee('Nombre');
       });
     }
 
     /** @test */
     public function vista_crear_ubicacion()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('ubicaciones/create')
                 ->assertSee('Nombre*');
       });
     }
 
      // prueba almacena rol en base de datos
      /** @test */
      public function llenado_formulario_crear_ubicacion()
      {
        $this->browse(function (Browser $browser) {
          $browser->visit('ubicaciones/create')
                 ->type('nombre', Str::random(6))
                 ->type('descripcion', Str::random(7))
                 ->type('locacion', Str::random(15))
                 ->press('Crear')
                 ->pause(1500)
                 ->assertSee('Ubicacion creada')
                 ->screenshot('guardar ubicacion');
        });
      }
 
      /** @test */
     public function vista_ver_ubicacion()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('ubicaciones/1')
                 ->assertSee('Nombre')
                 ->pause(1000);
       });
     }
 
     /** @test */
     public function vista_editar_ubicacion()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('ubicaciones/1/edit')
                 ->assertSee('Nombre')
                 ->pause(1000);
       });
     }
 
     // prueba editar ubicacion 3 en base de datos dusk
      /** @test */
      public function llenado_formulario_editar_ubicacion()
      {
        $this->browse(function (Browser $browser) {
          $browser->visit('ubicaciones/1/edit')
                 ->type('descripcion', Str::random(15))
                 ->press('Guardar')
                 ->pause(2000)
                 ->assertSee('Ubicacion modificada')
                 ->screenshot('modificar ubicacion');
        });
      }
}
