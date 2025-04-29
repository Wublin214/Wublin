<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Хешируем пароль
            'gender' => $this->faker->randomElement(['male', 'female']),
            'text' => $this->faker->paragraph,
            'textEducation' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'telegram' => '@'.$this->faker->userName,
            'vk' => 'vk.com/'.$this->faker->userName,
            'imag' => $this->faker->imageUrl(200, 200, 'people'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
