<?php

namespace App\Repositories\Bid;

use App\Abstracts\BaseCrudRepository;
use App\Models\Bid;
use App\Contracts\Repositories\BidRepositoryInterface;
use App\Exceptions\BidException;
use App\Models\User;
use App\Repositories\Ad\AdRepository;
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
            abort(404);
        });

        if ($ad->user_id === $user->id) {
            abort(403);
        }

        if (!$ad->active()) {
            throw new BidException('You cannot bid on an inactive ad.', $ad->slug);
        }

        $bidHistory = $this->model->where('ad_id', $ad->id)->orderBy('amount', 'desc')->first();
        if ($bidHistory && $bidHistory->amount >= $data['amount']) {
            throw new BidException('Your bid must be greater than the current bid.', $ad->slug);
        }

        $this->model->create([
            'ad_id' => $ad->id,
            'user_id' => $user->id,
            'amount' => $data['amount'],
        ]);
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
            ->paginate($limit);
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
        return $this->model->with(['ad:id,title,slug,price,status,started_at,expired_at', 'ad.user:id,name,avatar,username', 'payment:id,bid_id,amount,txn_id,status,created_at,gateway'])
            ->where('id', $bid)->where('user_id', $user->id)->firstOr(function () {
                abort(404);
            });
    }
}