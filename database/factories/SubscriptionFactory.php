<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{

    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'website_id' => Website::factory(),
            'user_id' => $this->faker->numberBetween(1, 255), 
        ];
    }
}
