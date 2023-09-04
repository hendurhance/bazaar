<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Media;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ads = Ad::factory()->count(100)->create();
        $ads->each(function ($ad) {
            $medias = Media::factory()->count(2)->create();
            $ad->media()->saveMany($medias);
        });
    }
}
