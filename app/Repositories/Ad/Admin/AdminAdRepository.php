<?php

namespace App\Repositories\Ad\Admin;

use App\Abstracts\BaseCrudRepository;
use App\Models\Ad;
use App\Contracts\Repositories\AdminAdRepositoryInterface;
use App\Enums\AdStatus;
use App\Exceptions\AdException;
use App\Models\ReportAd;
use App\Repositories\Category\CategoryRepository;
use App\Traits\MediaHandler;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class AdminAdRepository extends BaseCrudRepository implements AdminAdRepositoryInterface
{
    use MediaHandler;

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
                        ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                        ->orWhere('id', $filters['search'])
                        ->orWhere('user_id', $filters['search']);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($limit)
            ->appends(['search' => $filters['search'] ?? null]);
    }

    /**
     * Get ad by slug
     * 
     * @param string $slug
     * @return \App\Models\Ad
     */
    public function getAdBySlug(string $adSlug): Ad
    {
        return $this->model->query()->with(['user:id,name,avatar,username', 'media', 'category:id,name,slug', 'subcategory:parent_id,id,name,slug', 'bids', 'bids.user:id,name,avatar,username', 'country:id,name,iso2', 'state:id,name,code', 'city:id,name', 'relatedAds:id,title,slug,price', 'relatedAds.media',])
            ->where('slug', $adSlug)
            ->firstOr(function () {
                throw new AdException('Ad not found.');
            });
    }

    /**
     * Update ad by slug
     * 
     * @param string $slug
     * @param array $data
     * @return void
     */
    public function updateAd(string $slug, array $data): void
    {
        $ad = $this->model->where('slug', $slug)->firstOr(function () {
            throw new AdException('Ad not found.');
        });
        $category = isset($data['category']) ? app(CategoryRepository::class)->findBySlug($data['category']) : null;
        $subcategory = isset($data['subcategory']) ? app(CategoryRepository::class)->findBySlug($data['subcategory']) : null;

        DB::transaction(function () use ($data, $ad, $category, $subcategory) {
            $ad->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'category_id' => $category?->id ?? $ad->category_id,
                'sub_category_id' => $subcategory?->id ?? $ad->subcategory_id,
                'price' => $data['price'],
                'video_url' => $data['video_url'],
                'started_at' => Carbon::parse($data['start_date'])->format('Y-m-d H:00:00'),
                'expired_at' => Carbon::parse($data['end_date'])->format('Y-m-d H:00:00'),
                'seller_name' => $data['seller_name'],
                'seller_email' => $data['seller_email'],
                'seller_mobile' => $data['seller_mobile'] ?? $ad->seller_mobile,
                'seller_address' => $data['seller_address'] ?? $ad->seller_address,
                'status' => $data['status'],
            ]);
        });
    }

    /**
     * Get reported all ads
     * 
     * @param int $limit
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getReportedAds(int $limit = 10, array $filters = null): LengthAwarePaginator
    {
        return ReportAd::query()->with('ad:id,slug,title,status', 'ad.media')
            ->when($filters, function ($query) use ($filters) {
                $query->when(isset($filters['search']), function ($query) use ($filters) {
                    $query->whereHas('ad', function ($query) use ($filters) {
                        $query->where('title', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('description', 'like', '%' . $filters['search'] . '%')
                            ->orWhere('id', $filters['search']);
                    });
                });
            })
            ->orderBy('created_at','desc')
            ->paginate($limit)
            ->appends(['search' => $filters['search'] ?? null]);
    }


    /**
     * Get reported all ads
     * 
     * @param string $slug
     * @return \App\Models\ReportAd
     */
    public function getReportedAd(string $slug): \App\Models\ReportAd
    {
        return ReportAd::query()->with('ad:id,slug,title,status', 'ad.media', 'ad.user:id,name,avatar,username')
            ->whereHas('ad', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->firstOr(function () {
                throw new AdException('Ad not found.');
            });
    }

    /**
     * Delete ad by status
     * 
     * @param string $status
     * @param int $limit
     * @return void
     */
    public function deleteAd(string $adSlug): void
    {
        $ad = $this->model->where('slug', $adSlug)->firstOr(function () {
            throw new AdException('Ad not found.');
        });
        if($ad->status === AdStatus::PUBLISHED) {
            throw new AdException('Ad not found.');
        }

        $ad->media->each(function ($media) {
            $this->deleteMediaFile($media);
        });

        $ad->delete();
    }   
}
