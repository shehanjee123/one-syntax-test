<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('websites')->delete();

        Website::insert([
            [
                'name' => 'Blog WebSite',
                'url' => 'www.blog.com',
                'category' => 'Gossip'
            ],
            [
                'name' => 'News Line',
                'url' => 'www.newsline.com',
                'category' => 'News'
            ],
            [
                'name' => 'News Channel',
                'url' => 'www.newschannel.com',
                'category' => 'News'
            ],
            [
                'name' => 'Music Master',
                'url' => 'www.music.com',
                'category' => 'Entertainment'
            ],
            [
                'name' => 'Cricket Tips',
                'url' => 'www.Cricket.com',
                'category' => 'Sports'
            ],
            [
                'name' => 'The Dance Show',
                'url' => 'www.danceshow.com',
                'category' => 'Entertainment'
            ],
        ]);
    }
}
