<?php

namespace App\Repositories\Bid\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\Bid;
use App\Contracts\Repositories\BidRepositoryInterface;
use App\Enums\AdStatus;
use App\Exceptions\BidCustomException;
use App\Exceptions\BidException;
use App\Models\User;
use App\Notifications\Bid\BidAcceptedNotification;
use App\Notifications\Bid\BidCreatedNotification;
use App\Notifications\Bid\BidRejectedNotification;
use App\Repositories\Ad\User\AdRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BidRepository extends BaseCrudRepository implements BidRepositoryInterface
{
    public function __construct(Bid $model)
    {
        parent::__construct($model);
    }

    /**
     * Bid on an ad
     * 
     * @param string $ad
     * @param User $user
     * @param array $data
     * @return void
     */
    public function bid(string $ad, User $user, array $data): void
    {
        $ad = app(AdRepository::class)->findBy('slug', $ad, function () {
            throw new BidCustomException('Ad cannot be found or has been deleted.');
        });

        if ($ad->user_id === $user->id) {
            throw new BidException('You cannot bid on your own ad.', $ad->slug);
        }

        if (!$ad->active()) {
            throw new BidException('You cannot bid on an inactive ad.', $ad->slug);
        }

        $bidHistory = $this->model->where('ad_id', $ad->id)->orderBy('amount', 'desc')->first();
        if ($bidHistory && $bidHistory->amount >= $data['amount']) {
            throw new BidException('Your bid must be greater than the current bid.', $ad->slug);
        }

        $bid = $this->model->create([
            'ad_id' => $ad->id,
            'user_id' => $user->id,
            'amount' => $data['amount'],
        ]);

        $ad->user->notify(new BidCreatedNotification($ad, $bid, true));
        $user->notify(new BidCreatedNotification($ad, $bid, false));
    }

    /**
     * Get bids by user
     * 
     * @param User $user
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserBids(User $user, int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->with(['ad:id,title,slug,price,status,started_at,expired_at', 'ad.user:id,name,avatar,username', 'payment:id,bid_id,amount,txn_id,status'])
            ->where('user_id', $user->id)
            ->when($filters, function ($query, $filters) {
                if (isset($filters['sort'])) {
                    $query->orderBy(sort_query_parser($filters['sort'])[0], sort_query_parser($filters['sort'])[1]);
                }
            })
            ->paginate($limit)
            ->appends(['sort' => $filters['sort'] ?? null]);
    }

    /**
     * Get user bid
     * 
     * @param string $bid
     * @param User $user
     * @return \App\Models\Bid
     */
    public function getUserBid(string $bid, User $user): \App\Models\Bid
    {
        return $this->model->with(['ad:id,title,slug,price,status,started_at,expired_at,seller_name,seller_email,seller_mobile,seller_address', 'ad.user:id,name,avatar,username', 'payment:id,bid_id,amount,txn_id,status,created_at,gateway'])
            ->where('id', $bid)->where('user_id', $user->id)->firstOr(function () {
               throw new BidCustomException('Bid not found for this ad.');
            });
    }

    /**
     * Accept bid
     * 
     * @param string $adSlug
     * @param string $bidId
     * @param User $user
     * @return void
     */
    public function acceptBid(string $adSlug, string $bidId, User $user): void
    {
        $ad = app(AdRepository::class)->findBy('slug', $adSlug, function () {
            throw new BidCustomException('Ad not found.');
        });

        if ($ad->hasAcceptedBid()) {
            throw new BidException('Ad has already been sold.', $ad->slug, true);
        }

        $bid = $this->model->where('id', $bidId)->where('ad_id', $ad->id)->firstOr(function () use ($ad) {
            throw new BidException('Bid not found.', $ad->slug, true);
        });

        $bid->update(['is_accepted' => true]);

        $ad->update(['status' => AdStatus::EXPIRED, 'expired_at' => now()]);

        $bid->user->notify(new BidAcceptedNotification($ad, $bid));
        // Send notification to other bidders who lost the bid
        $this->model->where('ad_id', $ad->id)->where('id', '!=', $bid->id)->orWhere('is_accepted', false)->orWhereNull('is_accepted')->get()->each(function ($bid) use ($ad) {
            $bid->user->notify(new BidRejectedNotification($ad, $bid));
        });
    }
}
