<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
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


$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'genre' => $faker->randomElement(['Action', 'Adventure', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Historical', 'Horror', 'Mystery', 'Sci-Fi', 'Thriller', 'Western', 'Romance']),
        'description' => $faker->paragraph,
        'imdb' => $faker->randomDigit,
        'avatar' => $faker->unique()->numberBetween($min=1, $max=270).'.jpg',
        'releaseYear' => $faker->numberBetween($min=1950, $max=2020),
        'duration' => $faker->numberBetween($min=60, $max=200),
        'trailer' => $faker->domainName,
    ];

});
