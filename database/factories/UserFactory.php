<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;

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

$factory->define(App\User::class, function (Faker $faker) {
    //Faker\Generator
    $faker_es = FakerFactory::create('es_ES');
    return [
        'name' => $faker_es->name,
        'lastname' => $faker_es->lastName,
        'cedula' => $faker_es->dni,
        'phone' => $faker_es->phoneNumber,
        'email' => $faker_es->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('12345678'), // password $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
    ];
});

