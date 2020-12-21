<?php

namespace Database\Factories;

use App\Acting;
use App\Movie;
use App\Cast;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Acting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'movie_id' => Movie::all()->unique()->random()->id,
            'cast_id' => Cast::all()->unique()->random()->id,
            'created_at' => now()
        ];
    }
}
