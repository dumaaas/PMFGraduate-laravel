<?php

namespace Database\Factories;

use App\Rating;
use App\Movie;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'movie_id' => Movie::all()->unique()->random()->id,
            'review' => $this->faker->sentence(),
            'rating' => $this->faker->numberBetween($min=1, $max=10),
            'created_at' => now
        ];
    }
}
