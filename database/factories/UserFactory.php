<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['male', 'female'][rand(0, 1)];
        return [
            'name' => fake()->firstName($gender),
            'surname' => fake()->lastName($gender),
            'login' => fake()->unique()->word(),
            'phone' => '+7'. rand(100,999) .rand(10,99) .rand(10,99),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Администратор
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'login' => 'admin',
            'email' => 'admin@admin.net',
            'email_verified_at' => now(),
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
        ]);
    }

    /**
     * Пользователь
     */
    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'login' => 'user',
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
