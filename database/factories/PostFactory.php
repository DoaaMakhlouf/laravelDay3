<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(), 
            'body' => fake()->paragraph(),
            'image' => fake()->imageUrl(100, 100, 'images/posts/', true),
            'user_id' => User::factory(), // Creates a new User and assigns the ID
        ];
    }
}
