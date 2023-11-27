<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Media;
use App\Models\ReportAd;
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
            // create report for ad
            $reports = $ad->reports()->makeMany(
                ReportAd::factory()->count(rand(1, 5))->make()->toArray()
            );
            $ad->reports()->saveMany($reports);
            // I want diffrent 5-10 users to bid on the ad except the ad owner
            $users = User::where('id', '!=', $ad->user_id)->inRandomOrder()->limit(rand(5, 10))->get();
            $users->each(function ($user) use ($ad) {
                $bid = BidFactory::new([
                    'amount' => $ad->price + rand(100, 1000),
                ])->make();
                $bid->user_id = $user->id;
                $ad->bids()->save($bid);
            });
        });
    }
}
