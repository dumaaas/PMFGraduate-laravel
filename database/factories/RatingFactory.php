<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
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

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'movie_id' => Movie::all()->unique()->random()->id,
        'review' => $faker->sentence(),
        'rating' => $faker->numberBetween($min=1, $max=10),
    ];
});
