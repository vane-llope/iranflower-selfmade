<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'createdby' => $this->faker->word(),
            'updatedby' => $this->faker->word(),
            'tags' => 'laravel,bootstrap,api',
            'introduction' => $this->faker->sentence(3),
            'content' => $this->faker->sentence(6),
        ];
    }
}
