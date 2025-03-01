<?php

namespace Database\Factories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    protected $model = Website::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url,
            'category' => $this->faker->randomElement(['Gossip', 'News', 'Entertainment', 'Sports']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
