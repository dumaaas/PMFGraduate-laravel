<?php

namespace Database\Factories;

use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'userName' => $this->faker->unique()->userName,
            'phoneNumber' => $this->faker->phoneNumber,
            'role' => 'user',
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'privacy' => 'public',
            'avatar' => $this->faker->unique()->numberBetween($min=1, $max=72).'.jpg',
            'email' => $this->faker->unique()->safeEmail,
            'description' => $this->faker->paragraph,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => now()
        ];
    }
}
