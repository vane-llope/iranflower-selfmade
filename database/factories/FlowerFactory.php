<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'tags' => 'laravel,bootstrap,api',
            'summary' => $this->faker->paragraph(4),
            'introduction' => $this->faker->paragraph(5),
            'irrigation' => $this->faker->paragraph(3),
            'light' => $this->faker->paragraph(3),
            'temperature' => $this->faker->paragraph(3),
            'soil' => $this->faker->paragraph(3),
            'compost' => $this->faker->paragraph(3),
        ];
    }
}
