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
        $users = User::all();
        $users->each(function ($user) {
            $this->createAdsForUser($user->id);
        });
    }

    /**
     * Create ads for a user.
     *
     * @param string $user_id
     */
    private function createAdsForUser(string $user_id): void
    {
        $ads = Ad::factory()->count(rand(5, 15))->create(
            [
                'user_id' => $user_id,
            ]
        );
        $ads->each(function ($ad) {
            $medias = Media::factory()->count(2)->create();
            $ad->media()->saveMany($medias);
            // create a bid for each ad using random user
            $bid = BidFactory::new()->count(rand(3, 5))->create([
                'ad_id' => $ad->id,
                'user_id' => User::where('id', '!=', $ad->user_id)->inRandomOrder()->first()->id,
            ]);
        });
    }
}
