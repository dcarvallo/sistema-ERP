<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use Illuminate\Support\Str;

class UsuariosControllerTest extends DuskTestCase
{


    /** @test */
    public function vista_usuarios()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('users')
                ->type('username', 'admin')
                ->type('password', 'admin')
                ->press('Ingresar')
                ->assertSee('Nombre')
                ->pause(1000);
      });
    }

    /** @test */
    public function vista_crear_usuario()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('users/create')
                ->assertSee('Nombres*')
                ->pause(1000);
      });
    }

      // prueba almacena usuario en base de datos
     /** @test */
     public function llenado_formulario_crear_usuario()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('users/create')
                ->type('nombres', Str::random(6).' nombre')
                ->type('apellidos', Str::random(7).' apellido')
                ->type('username', Str::random(7))
                ->type('email', Str::random(10).'@erp.com')
                ->type('password', 'Passw0rd')
                ->select('activo', 1)
                ->press('Guardar')
                ->pause(2000)
                ->assertSee('Usuario creado')
                ->screenshot('guardar usuario');
       });
     }

    /** @test */
    public function vista_ver_usuario()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('users/1')
                ->assertSee('Nombres')
                ->pause(1000);
      });
    }

    /** @test */
    public function vista_editar_usuario()
    {
      $this->browse(function (Browser $browser) {
        $browser->visit('users/1/edit')
                ->assertSee('Nombres')
                ->pause(1000);
      });
    }

     // prueba editar usuario admin en base de datos
     /** @test */
     public function llenado_formulario_editar_usuario()
     {
       $this->browse(function (Browser $browser) {
         $browser->visit('users/1/edit')
                ->type('nombres', Str::random(6).' nombre')
                ->type('apellidos', Str::random(7).' apellido')
                ->press('Guardar')
                ->pause(2000)
                ->assertSee('Usuario modificado')
                ->screenshot('modificar usuario');
       });
     }

   
}
