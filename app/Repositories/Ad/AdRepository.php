<?php

namespace App\Repositories\Ad;

use App\Abstracts\BaseCrudRepository;
use App\Models\Ad;
use App\Contracts\Repositories\AdRepositoryInterface;
use App\Enums\AdStatus;
use App\Enums\PriceRange;
use App\Enums\StorageDiskType;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Country\CountryRepository;
use App\Traits\MediaHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AdRepository extends BaseCrudRepository implements AdRepositoryInterface
{
    use MediaHandler;

    public function __construct(Ad $model)
    {
        parent::__construct($model);
    }

    /**
     * Create an ad listing.
     * 
     * @param ?User $user|null
     * @param array $data
     * @return Ad
     */
    public function create(?User $user, array $data): Ad
    {
        return DB::transaction(function () use ($user, $data) {
            $ad = $this->store($user, $data);
            $this->uploadMedia($ad, $data['images'] ?? [], StorageDiskType::LOCAL, 'public/ad', 640, 480, $user);
            return $ad;
        });
    }

    /**
     * Get ad by slug
     * 
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getAd(string $slug): Ad
    {
        return $this->model->with(['user:id,name,avatar,username', 'media', 'category:id,name', 'bids', 'bids.user:id,name,avatar,username', 'relatedAds:id,title,slug,price', 'relatedAds.media'])
            ->where('slug', $slug)
            ->firstOr(function () {
                abort(404);
            });
    }

    /**
     * Get latest active|upcoming ads
     * 
     * @param int $limit
     * @param string $type = 'active' <active|upcoming>
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLatestAds(int $limit = 10, string $type = 'active', array $filters = null): LengthAwarePaginator
    {
        return $this->model->with(['user:id,name,avatar,username', 'media', 'category:id,name'])
            ->when($type === 'active', function ($query) {
                $query->active();
            }, function ($query) {
                $query->upcoming();
            })
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['category']), function ($query) use ($filters) {
                    $query->where('category_id', app(CategoryRepository::class)->findBySlug($filters['category'])->id);
                })
                    ->when(isset($filters['country']), function ($query) use ($filters) {
                        $query->where('country_id', app(CountryRepository::class)->findByIso2Code($filters['country'])->id);
                    })
                    ->when(isset($filters['price_range']), function ($query) use ($filters) {
                        $query->whereBetween('price', PriceRange::range($filters['price_range']));
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Store an ad listing.
     * 
     * @param ?User $user|null
     * @param array $data
     * @return Ad
     */
    protected function store(?User $user, array $data): Ad
    {
        $category = app(CategoryRepository::class)->findBySlug($data['category']);
        $subcategory = app(CategoryRepository::class)->findBySlug($data['subcategory']);
        $country = app(CountryRepository::class)->findByIso2Code($data['country']);
        $state = app(CountryRepository::class)->findStateByCode($country->id, $data['state']);

        return $this->model->create([
            'user_id' => $user->id ?? null,
            'category_id' => $category->id,
            'sub_category_id' => $subcategory->id,
            'country_id' => $country->id,
            'state_id' => $state->id,
            'city_id' => $data['city'],
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'video_url' => $data['video_url'] ?? null,
            'status' => AdStatus::PENDING,
            'started_at' => $data['start_date'],
            'expired_at' => $data['end_date'],
            'seller_name' => $user?->name ?? $data['seller_name'],
            'seller_email' => $user?->email ?? $data['seller_email'],
            'seller_mobile' => $user?->mobile ?? $data['seller_mobile'],
            'seller_address' => $user?->address ?? $data['seller_address'],
        ]);
    }
}
