<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class AreaControllerTest extends DuskTestCase
{
    /** @test */
    public function vista_de_areas()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('areas')
                ->type('username', 'admin')
                ->type('password', 'admin')
                ->press('Login')
                ->assertSee('Nombre');
      });
    }

    /** @test */
    public function vista_crear_area()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('areas/create')
                ->assertSee('Nombre*');
      });
    }

     // prueba almacena rol en base de datos
     /** @test */
     public function llenado_formulario_crear_area()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('areas/create')
                ->type('#nombre', Str::random(6))
                ->type('#descripcion', Str::random(7))
                ->press('#encargado')
                ->press('Cargo 1')
                ->select('#Departamento','Departamento 1' )
                // ->press()
                ->pause(5000)
                ->press('Crear')
                ->pause(1500)
                ->assertSee('area creada')
                ->screenshot('guardar area');
       });
     }

     /** @test */
    public function vista_ver_area()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('areas/1')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    /** @test */
    public function vista_editar_area()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('areas/1/edit')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    // prueba editar area 3 en base de datos dusk
     /** @test */
     public function llenado_formulario_editar_area()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('areas/1/edit')
                ->type('descripcion', Str::random(15))
                ->press('Guardar')
                ->pause(2000)
                ->assertSee('area modificada')
                ->screenshot('modificar area');
       });
     }
}
