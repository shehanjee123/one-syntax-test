<?php

namespace Database\Factories;

use App\Models\SubcriptionUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubcriptionUser>
 */
class SubcriptionUserFactory extends Factory
{

    protected $model = SubcriptionUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => $this->faker->unique()->safeEmail,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
