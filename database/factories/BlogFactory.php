<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'slug' => $this->faker->slug(),
            'category_id'=>1,
            'image'=>'default.png',
            'user_id' => 1,
            'body' => $this->faker->paragraph()
        ];
    }
}
