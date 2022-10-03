<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentences(8, true),
            'image' => $this->faker->imageUrl(),
            'user_id' => $this->faker->unique()->numberBetween(1, User::count()),
            'category_id' => $this->faker->unique()->numberBetween(1, Category::count()),
        ];
    }
}
