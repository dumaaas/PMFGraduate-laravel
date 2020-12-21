<?php

namespace Database\Factories;

use App\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'genre' => $this->faker->randomElement(['Action', 'Adventure', 'Comedy', 'Crime', 'Drama', 'Fantasy', 'Historical', 'Horror', 'Mystery', 'Sci-Fi', 'Thriller', 'Western', 'Romance']),
            'description' => $this->faker->paragraph,
            'imdb' => $this->faker->randomDigit,
//            'avatar' => $this->faker->unique()->numberBetween($min=1, $max=270).'.jpg',
            'avatar' => 'default.jpg',

            'releaseYear' => $this->faker->numberBetween($min=1950, $max=2020),
            'duration' => $this->faker->numberBetween($min=60, $max=200),
            'trailer' => $this->faker->domainName,
        ];
    }
}
