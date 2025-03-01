<?php

namespace Database\Factories;

use App\Models\Website;
use App\Models\WebsitePost;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebsitePost>
 */
class WebsitePostFactory extends Factory
{
    protected $model = WebsitePost::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_title' => $this->faker->sentence,
            'post_description' => $this->faker->paragraph,
            'website_id' => Website::factory(),
            'is_publish' => 1,
        ];
    }
}
