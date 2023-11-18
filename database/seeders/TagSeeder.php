<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'Technology',
            'Art',
            'Auction',
            'Business',
            'Bidding',
            'How to',
            'Guide',
            'Tips',
            'Tricks',
            'Tutorials',
            'News',
            'Updates',
        ];

        foreach ($tags as $tag) {
            Tag::factory()->create([
                'name' => $tag,
            ]);
        }
    }
}
