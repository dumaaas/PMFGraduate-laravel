<?php

namespace Database\Factories;

use App\MovieList;
use App\Movie;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MovieList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->unique()->random()->id,
            'movie_id' => Movie::all()->unique()->random()->id,
            'type' =>$this->faker->randomElement(['watchlist', 'custom', 'watched', 'favorite']),
            'created_at' => now()
        ];
    }
}
