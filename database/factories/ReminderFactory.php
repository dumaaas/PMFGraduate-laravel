<?php

namespace Database\Factories;

use App\Reminder;
use App\Movie;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReminderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reminder::class;

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
            'status' => 'pending',
            'reminder_date' => $this->faker->dateTimeBetween(),
            'created_at' => now()
        ];
    }
}
