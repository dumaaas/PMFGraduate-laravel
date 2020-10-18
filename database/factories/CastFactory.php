<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cast;
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

$factory->define(Cast::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'movieName' => $faker->name,
        'wikipedia' => $faker->domainName,
        'occupation' => $faker->randomElement(['Actor', 'Director', 'Actress']),
        'description' => $faker->paragraph,
        'avatar' => $faker->unique()->numberBetween($min=1, $max=53).'.jpg',
        'country' => $faker->country,
        'birthDate' => $faker->numberBetween($min=1950, $max=2020).'-'.$faker->numberBetween($min=1, $max=12).'-'.$faker->numberBetween($min=1, $max=31),
        'height' => $faker->numberBetween($min=150, $max=220),
    ];
});
