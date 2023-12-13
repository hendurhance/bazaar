<?php

namespace App\Repositories\Bid\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Bid;
use App\Contracts\Repositories\AdminBidRepositoryInterface;
use App\Enums\PriceRange;
use App\Exceptions\BidCustomException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminBidRepository extends BaseCrudRepository implements AdminBidRepositoryInterface
{
    public function __construct(Bid $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all bids
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBids(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['ad:id,slug,price,title', 'user:id,name,avatar,username'])
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['accepted']), function ($query) use ($filters) {
                    $query->where('is_accepted', $filters['accepted'] === 'accepted' ? true : ($filters['accepted'] === 'rejected' ? false : null));
                })
                    ->when(isset($filters['price_range']), function ($query) use ($filters) {
                        $query->whereBetween('amount', PriceRange::range($filters['price_range']));
                    })
                    ->when(isset($filters['date_from']) && isset($filters['date_to']), function ($query) use ($filters) {
                        $query->whereBetween('created_at', [$filters['date_from'], $filters['date_to']]);
                    })
                    ->when(isset($filters['bid_id']), function ($query) use ($filters) {
                        $query->where('id', $filters['bid_id'])
                            ->orWhere('user_id', $filters['bid_id']);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends([
                'accepted' => $filters['accepted'] ?? null,
                'price_range' => isset($filters['amount_from']) ? PriceRange::range($filters['price_range']) : null,
                'amount_to' => $filters['amount_to'] ?? null,
                'date_from' => $filters['date_from'] ?? null,
                'date_to' => $filters['date_to'] ?? null,
                'bid_id' => $filters['bid_id'] ?? null,
            ]);
    }

    /**
     * Get bid by id
     * 
     * @param string $id
     * @return \App\Models\Bid
     */
    public function getBid(string $id): Bid
    {
        return $this->model->with(['ad:id,slug,price,title', 'user:id,name,avatar,username'])
            ->where('id', $id)
            ->firstOr(function () {
                throw new BidCustomException('Bid not found for this ad.');
            });
    }
}
