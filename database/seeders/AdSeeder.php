<?php

namespace Database\Seeders;

use App\Models\Ad;
use App\Models\Bid;
use App\Models\Media;
use App\Models\Payment;
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
                'created_at' => now()->subDays(rand(1, 10)),
            ]
        );
        $ads->each(function ($ad) {
            $medias = Media::factory()->count(rand(2,3))->create();
            $ad->media()->saveMany($medias);
            // create report for ad
            $reports = $ad->reports()->makeMany(
                ReportAd::factory()->count(rand(1, 5))->make()->toArray()
            );
            $ad->reports()->saveMany($reports);
            // I want different 5-10 users to bid on the ad except the ad owner
            $users = User::where('id', '!=', $ad->user_id)->inRandomOrder()->limit(rand(5, 10))->get();
            $users->each(function ($user) use ($ad) {
                $bid = BidFactory::new([
                    'amount' => $ad->price + rand(100, 1000),
                    'created_at' => $ad->created_at->addDays(rand(1, 10)),
                ])->make();
                $bid->user_id = $user->id;
                $ad->bids()->save($bid);
            });
        });

        // Get all bids that are accepted
        $acceptedBids = Bid::where('is_accepted', true)->get();
        // Create one payment for each accepted bid
        $acceptedBids->each(function ($bid) {
            $payment = Payment::factory()->make([
                'ad_id' => $bid->ad_id,
                'payer_id' => $bid->user_id,
                'payee_id' => $bid->ad->user_id,
                'bid_id' => $bid->id,
                'amount' => $bid->amount,
                'created_at' => $bid->created_at->addDays(rand(1, 10)),
            ]);
            $bid->payment()->save($payment);
        });

    }
}
