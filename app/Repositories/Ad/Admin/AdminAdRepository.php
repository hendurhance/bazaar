<?php

namespace App\Repositories\Ad\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Ad;
use App\Contracts\Repositories\AdminAdRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminAdRepository extends BaseCrudRepository implements AdminAdRepositoryInterface
{
    public function __construct(Ad $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all ads
     * 
     * @param int $limit
     * @param string $type = 'all' <all|active|upcoming|pending|expired|rejected>
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAds(int $limit = 10, string $type, array $filters = null): LengthAwarePaginator
    {
        return $this->model->query()->with(['user:id,name,avatar,username', 'media', 'category:id,name'])
            ->when(
                match ($type) {
                    'active' => fn ($query) => $query->active(),
                    'upcoming' => fn ($query) => $query->upcoming(),
                    'pending' => fn ($query) => $query->pending(),
                    'expired' => fn ($query) => $query->expired(),
                    'rejected' => fn ($query) => $query->rejected(),
                    'all' => fn ($query) => $query,
                }
            )
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->where('title', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('description', 'like', '%' . $filters['search'] . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get ad by slug
     * 
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getAdBySlug(string $adSlug): Ad
    {
        return $this->model->query()->with(['user:id,name,avatar,username', 'media', 'category:id,name', 'subcategory:parent_id,id,name', 'bids', 'bids.user:id,name,avatar,username', 'country:id,name,iso2', 'state:id,name,code', 'city:id,name', 'relatedAds:id,title,slug,price', 'relatedAds.media',])
            ->where('slug', $adSlug)
            ->firstOr(function () {
                #TODO: throw custom exception
                abort(404);
            });
    }
}
