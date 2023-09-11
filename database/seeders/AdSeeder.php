<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Media;
use App\Models\User;
use Database\Factories\BidFactory;
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
            // create a bid for each ad using random user
            $bid = BidFactory::new()->create([
                'ad_id' => $ad->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ]);
        });
    }
}
