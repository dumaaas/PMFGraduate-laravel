<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Favoritecast;
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

$factory->define(Favoritecast::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->unique()->random()->id,
        'cast_id' => Cast::all()->unique()->random()->id,
    ];
});
