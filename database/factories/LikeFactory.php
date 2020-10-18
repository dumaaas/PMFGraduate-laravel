<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Like;
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

$factory->define(Like::class, function (Faker $faker) {
    return [

        'user_id' => User::all()->unique()->random()->id,
        'comment_id' => Comment::all()->random()->id,
        'liked' => $faker->boolean(),
    ];
});
