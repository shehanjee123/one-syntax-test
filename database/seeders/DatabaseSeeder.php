<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Subscription;

use App\Models\Website;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Website::factory()->count(2)->create()->each(function ($website) {
            Subscription::factory()->count(3)->create(['website_id' => $website->id]);
        });
    }
}
