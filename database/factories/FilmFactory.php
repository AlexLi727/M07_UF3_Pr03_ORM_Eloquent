<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{

    // protected $model = Film::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'year' => fake()->year(),
            'genre' => fake()->word(),
            'country' => fake()->country(), // password
            'duration' => fake()->numberBetween(1, 360),
            'director_id' => 5,
            'img_url' => fake()->imageUrl()
        ];
    }
}
