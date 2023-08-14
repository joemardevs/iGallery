<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artwork>
 */
class ArtworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'title' => fake()->word(),
            'price' => fake()->numberBetween($min = 10000, $max = 100000),
            'artist_name' => fake()->name(),
            'description' => fake()->sentence(),
            'address' => fake()->city(),
            'created_date' => fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
