<?php

namespace Database\Factories;

use App\Cast;
use Illuminate\Database\Eloquent\Factories\Factory;

class CastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cast::class;

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
            'movieName' => $this->faker->name,
            'wikipedia' => $this->faker->domainName,
            'occupation' => $this->faker->randomElement(['Actor', 'Director', 'Actress']),
            'description' => $this->faker->paragraph,
            'avatar' => $this->faker->numberBetween($min=1, $max=53).'.jpg',
            'country' => $this->faker->country,
            'birthDate' => $this->faker->numberBetween($min=1950, $max=2020).'-'.$this->faker->numberBetween($min=1, $max=12).'-'.$this->faker->numberBetween($min=1, $max=31),
            'height' => $this->faker->numberBetween($min=150, $max=220),
        ];
    }
}
