<?php

namespace Database\Factories;

use App\Likeable;
use App\Comment;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Likeable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'likeable_type' => 'App\Comment',
            'likeable_id' => Comment::all()->random()->id,
            'liked' => $this->faker->randomElement(['up', 'down']),
            'created_at' => now()
        ];
    }
}
