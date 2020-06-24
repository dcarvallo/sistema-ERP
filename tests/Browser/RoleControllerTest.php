<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Support\Str;

class RoleControllerTest extends DuskTestCase
{
    /** @test */
    public function vista_de_roles()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('roles')
                ->type('username', 'admin')
                ->type('password', 'admin')
                ->press('Login')
                ->assertSee('Nombre');
      });
    }

    /** @test */
    public function vista_crear_rol()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('roles/create')
                ->assertSee('Nombre*')
                ->assertSee('Permisos')
                ->pause(1000);
      });
    }

     // prueba almacena rol en base de datos
     /** @test */
     public function llenado_formulario_crear_rol()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('roles/create')
                ->type('name', Str::random(6))
                ->type('description', Str::random(7))
                ->press('.fa-plus-square')
                ->type('category', Str::random(5))
                ->press('Guardar')
                ->pause(1500)
                ->assertSee('Rol creado')
                ->screenshot('guardar rol');
       });
     }

     /** @test */
    public function vista_ver_rol()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('roles/3')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    /** @test */
    public function vista_editar_rol()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('roles/3/edit')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    // prueba editar rol 3 en base de datos dusk
     /** @test */
     public function llenado_formulario_editar_rol()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('roles/3/edit')
                ->type('description', Str::random(15))
                ->press('Guardar')
                ->pause(2000)
                ->assertSee('Rol modificado')
                ->screenshot('modificar rol');
       });
     }
}
