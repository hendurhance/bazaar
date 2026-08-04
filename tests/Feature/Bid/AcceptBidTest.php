<?php

namespace Tests\Feature\Bid;

use App\Contracts\Repositories\BidRepositoryInterface;
use App\Enums\AdStatus;
use App\Exceptions\BidException;
use App\Models\Ad;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Country;
use App\Models\User;
use App\Notifications\Bid\BidRejectedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AcceptBidTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Country::create(['iso2' => 'NG', 'iso3' => 'NGA', 'name' => 'Nigeria']);
        Category::create(['name' => 'Electronics', 'slug' => 'electronics']);
    }

    public function test_a_user_cannot_accept_a_bid_on_an_ad_they_do_not_own(): void
    {
        $seller = User::factory()->create();
        $intruder = User::factory()->create();
        $ad = Ad::factory()->for($seller)->create(['status' => AdStatus::PUBLISHED]);
        $bid = Bid::factory()->for($ad)->for(User::factory())->create(['is_accepted' => null]);

        $this->expectException(BidException::class);

        app(BidRepositoryInterface::class)->acceptBid($ad->slug, $bid->id, $intruder);

        $this->assertDatabaseHas('bids', ['id' => $bid->id, 'is_accepted' => null]);
    }

    public function test_accepting_a_bid_only_rejects_other_bids_on_the_same_ad(): void
    {
        Notification::fake();

        $seller = User::factory()->create();
        $ad = Ad::factory()->for($seller)->create(['status' => AdStatus::PUBLISHED]);
        $winningBid = Bid::factory()->for($ad)->for(User::factory())->create(['is_accepted' => null]);
        $losingBid = Bid::factory()->for($ad)->for(User::factory())->create(['is_accepted' => null]);

        $unrelatedAd = Ad::factory()->for(User::factory())->create(['status' => AdStatus::PUBLISHED]);
        $unrelatedBid = Bid::factory()->for($unrelatedAd)->for(User::factory())->create(['is_accepted' => null]);

        app(BidRepositoryInterface::class)->acceptBid($ad->slug, $winningBid->id, $seller);

        Notification::assertSentTo($losingBid->user, BidRejectedNotification::class);
        Notification::assertNotSentTo($unrelatedBid->user, BidRejectedNotification::class);
    }
}
