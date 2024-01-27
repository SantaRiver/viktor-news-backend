<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NewsImage>
 */
class NewsImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'news_id' => News::query()->inRandomOrder()->first()->id,
            'path' => $this->faker->imageUrl(),
        ];
    }
}
