<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class DepartamentoControllerTest extends DuskTestCase
{
    /** @test */
    public function vista_de_departamentos()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('departamentos')
                ->type('username', 'admin')
                ->type('password', 'admin')
                ->press('Login')
                ->assertSee('Nombre');
      });
    }

    /** @test */
    public function vista_crear_departamento()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('departamentos/create')
                ->assertSee('Nombre*');
      });
    }

     // prueba almacena departamento en base de datos
     /** @test */
     public function llenado_formulario_crear_departamento()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('departamentos/create')
                ->type('nombre', Str::random(6))
                ->type('descripcion', Str::random(7))
                ->type('ubicacion', 1)
                ->press('Crear')
                ->pause(1500)
                ->assertSee('departamento creada')
                ->screenshot('guardar departamento');
       });
     }

     /** @test */
    public function vista_ver_departamento()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('departamentos/1')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    /** @test */
    public function vista_editar_departamento()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('departamentos/1/edit')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    // prueba editar departamento 3 en base de datos dusk
     /** @test */
     public function llenado_formulario_editar_departamento()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('departamentos/1/edit')
                ->type('descripcion', Str::random(15))
                ->press('Guardar')
                ->pause(2000)
                ->assertSee('departamento modificada')
                ->screenshot('modificar departamento');
       });
     }
}
