<?php

namespace App\Repositories\Ad\User;

use App\Abstracts\BaseCrudRepository;
use App\Models\Ad;
use App\Contracts\Repositories\AdRepositoryInterface;
use App\Enums\AdStatus;
use App\Enums\PriceRange;
use App\Enums\StorageDiskType;
use App\Exceptions\AdException;
use App\Models\ReportAd;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Country\CountryRepository;
use App\Traits\MediaHandler;
use Carbon\Carbon;
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
        return $this->model->with(['user:id,name,avatar,username', 'media', 'category:id,name', 'bids', 'bids.user:id,name,avatar,username', 'relatedAds:id,title,slug,price', 'relatedAds.media', 'relatedAds.user:id,username,avatar', 'highestBid:id,amount'])
            ->whereNot('status', AdStatus::PENDING)
            ->where('slug', $slug)
            ->firstOr(function () {
                throw new AdException('Ad not found.');
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
        return $this->model->query()->with(['user:id,name,avatar,username', 'media', 'category:id,name'])
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
            ->paginate($limit)
            ->appends([
                'category' => $filters['category'] ?? null,
                'country' => $filters['country'] ?? null,
                'price_range' =>  isset($filters['amount_from']) ? PriceRange::range($filters['price_range']) : null,
            ]);
    }

    /**
     * Get ads by user
     * 
     * @param \App\Models\User $user
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getUserAds(User $user, int $limit = 10, array $filters = null): Collection|LengthAwarePaginator
    {
        return $this->model->query()->where('user_id', $user->id)->with(['media'])
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $status = $filters['status'];
                $query->$status();
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get user ad by slug
     * 
     * @param \App\Models\User $user
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getUserAd(User $user, string $slug): Ad
    {
        return $this->model->query()->with(['user:id,name,avatar,username', 'media', 'category:id,name', 'subcategory:parent_id,id,name', 'bids', 'bids.user:id,name,avatar,username', 'country:id,name,iso2', 'state:id,name,code', 'city:id,name'])
            ->where('user_id', $user->id)
            ->where('slug', $slug)
            ->firstOr(function () {
                throw new AdException('Ad cannot be found, or it does not belong to you.');
            });
    }

    /**
     * Update an ad
     * 
     * @param \App\Models\User $user
     * @param string $ad
     * @param array $data
     * @return void
     */
    public function updateUserAd(User $user, string $ad, array $data): void
    {
        $ad = $this->model->where('user_id', $user->id)->where('slug', $ad)->firstOr(function () {
            throw new AdException('You cannot update this ad, or it does not belong to you.');
        });

        $ad->update([
            'title' => $data['title'] ?? $ad->title,
            'description' => $data['description'] ?? $ad->description,
            'price' => $data['price'] ?? $ad->price,
            'video_url' => $data['video_url'] ?? $ad->video_url,
            'seller_name' => $data['seller_name'] ?? $ad->seller_name,
            'seller_mobile' => $data['seller_mobile'] ?? $ad->seller_mobile,
            'seller_address' => $data['seller_address'] ?? $ad->seller_address,
        ]);
    }

    /**
     * Get ad by slug
     * 
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getReportAd(string $slug): Ad
    {
        return $this->model->query()
            ->whereNot('status', AdStatus::PENDING)
            ->where('slug', $slug)
            ->firstOr(function () {
                throw new AdException('Ad not be reported because it does not exist.');
            });
    }

    /**
     * Report an ad
     * 
     * @param \App\Models\User $user
     * @param string $slug
     * @param array $data
     * @return void
     */
    public function reportAd(string $slug, array $data): void
    {
        ReportAd::create([
            'ad_id' => $this->getReportAd($slug)->id,
            'reason' => $data['reason'],
            'description' => $data['description'],
            'email' => $data['email'],
        ]);
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
            'started_at' => Carbon::parse($data['start_date'])->format('Y-m-d H:00:00'),
            'expired_at' => Carbon::parse($data['end_date'])->format('Y-m-d H:00:00'),
            'seller_name' => $user?->name ?? $data['seller_name'],
            'seller_email' => $user?->email ?? $data['seller_email'],
            'seller_mobile' => $user?->mobile ?? $data['seller_mobile'],
            'seller_address' => $user?->address ?? $data['seller_address'],
        ]);
    }
}
