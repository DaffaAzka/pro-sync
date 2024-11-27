<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(4, true),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['ongoing', 'completed']),
            'slug' => $this->generateRandomString(),
            'start_date' => $this->faker->dateTimeBetween('-4 week', '-1 week'),
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+4 week'),
        ];
    }

    function generateRandomString($length = 24): string
    {
        // Generate a random string
        $randomString = substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);

        // Split the string into chunks of 4 characters
        $chunks = str_split($randomString, 4);

        // Join the chunks with a dash
        return implode('-', $chunks);
    }

}
