<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
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
            'flower' => 'crud',
            'product' => 'crud',
            'allproducts' => 'crud',
            'role' => 'crud',
            'user' => 'crud',
            'article' => 'crud',
        ];
    }
}
