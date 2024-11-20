<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(1),
            'theme' => fake()->sentence(1),
            'price' => fake()->numberBetween(1000, 10000),
            'description' => fake()->text(100),
            // 'status' => fake()->randomElement(['Решена']),
            'status' => fake()->randomElement(['Обупликовано', 'На модерации', 'В архиве', 'Откликнулись', 'Куплено']),
            'reason' => fake()->text(100),
            'publicationDate' => fake()->dateTimeBetween('-1 year', 'now')
        ];
    }
}
