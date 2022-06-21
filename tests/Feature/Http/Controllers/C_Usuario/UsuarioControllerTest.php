<?php

namespace Tests\Feature\Http\Controllers\C_Usuario;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Str;

class UsuarioControllerTest extends TestCase
{

    /** @test */
    public function verifica_vista_usuarios()
    {

      $this->actingAs(User::find(1))
            ->get('users')
            ->assertStatus(200)
            ->assertSee('Admin');
    }

    /** @test */
    public function verifica_vista_usuarios_sin_usuario_autenticado()
    {

      $this->get('users')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /** @test */
    public function verifica_vista_crear_usuarios()
    {

      $this->actingAs(User::find(1))
            ->get('users/create')
            ->assertSuccessful()
            ->assertSeeText('Crear Usuario');
    }

    /** @test */
    public function verifica_almacenar_usuarios()
    {
      
      $response = $this->actingAs(User::find(1))
                      ->postJson(route('users.store'), [
                          'nombres' => 'nombre usuario1',
                          'apellidos' => 'apellido usuario1',
                          'username' => 'usuario1',
                          'email' => Str::random(10).'@erp.com',
                          'activo' => 1,
                          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', //password
                          // 'imagen' => UploadedFile::fake()->image('avatar.jpg',300,300),
                      ]);

        $response->assertStatus(200);
        $response->assertSee('nombre usuario1');
    }

    /** @test */
    public function verifica_vista_ver_usuario()
    {

      $this->actingAs(User::find(1))
            ->get('/users/1')
            ->assertStatus(200)
            ->assertSee('mostrarusuario');
    }

    /** @test */
    public function verifica_vista_editar_usuarios()
    {

      $this->actingAs(User::find(1))
            ->get('users/1/edit')
            ->assertStatus(200)
            ->assertSee('editarusuario');
    }
}
