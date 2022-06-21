<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\M_Empresa\Ubicacion;
use Faker\Generator as Faker;

$factory->define(Ubicacion::class, function (Faker $faker) {
    return [
        'nombre' => $faker->streetName,
        'descripcion' => $faker->text(100),
        'locacion' => $faker->streetAddress,
        'empresa_id' => 1,
    ];
});
