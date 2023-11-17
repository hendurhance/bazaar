<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory()->count(15)->create([
            'admin_id' => Admin::first()->id,
        ]);
    }
}
