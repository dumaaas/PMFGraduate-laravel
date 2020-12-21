<?php

namespace Database\Factories;

use App\Chat;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sender_user_id' => User::all()->random()->id,
            'receiver_user_id' => User::all()->random()->id,
            'message' => $this->faker->sentence,
            'created_at' => now()
        ];
    }
}
