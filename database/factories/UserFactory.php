<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'userName' => $faker->unique()->userName,
        'phoneNumber' => $faker->phoneNumber,
        'role' => 'user', 
        'country' => $faker->country,
        'city' => $faker->city,
        'privacy' => 'private',
        'avatar' => $faker->unique()->numberBetween($min=1, $max=72).'.jpg',
        'email' => $faker->unique()->safeEmail,
        'description' => $faker->paragraph,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
