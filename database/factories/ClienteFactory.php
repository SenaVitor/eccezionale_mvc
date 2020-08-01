<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Cliente::class, function (Faker $faker) {
    return [
        'nome_cliente' => $faker->name,
        'sobrenome_cliente' => $faker->name,
        'email_cliente' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->randomDigit,
        'email_verified_at' => now(),
        'senha_cliente' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
