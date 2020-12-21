<?php

namespace Database\Factories;

use App\Comment;
use App\Movie;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'commentable_type' => 'App\Movie',
            'commentable_id' => Movie::all()->random()->id,
            'content' => $this->faker->paragraph,
            'created_at' => now()
        ];
    }
}
