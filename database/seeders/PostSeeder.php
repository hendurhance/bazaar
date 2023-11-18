<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Media;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post = Post::factory()->count(15)->create([
            'admin_id' => Admin::first()->id,
        ]);

        // create 3 media for each post and attach the first media as featured image
        // attach 1 tag for each post
        $post->each(function (Post $post) {
            $post->media()->saveMany(
                Media::factory()->count(3)->make()
            );
            $post->update(['featured_image_id' => $post->media->first()->id]);
            $post->tags()->attach(
                Tag::factory()->count(1)->create()
            );
        });
    }
}
