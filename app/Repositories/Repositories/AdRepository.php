<?php

namespace App\Repositories\Repositories;

use App\Abstracts\BaseCrudRepository;
use App\Models\Ad;
use App\Contracts\Repositories\AdRepositoryInterface;
use App\Enums\AdStatus;
use App\Models\Category;
use App\Models\User;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Country\CountryRepository;

class AdRepository extends BaseCrudRepository implements AdRepositoryInterface
{
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
        // Handle media upload and creation
        $media = $this->uploadMedia($data['images'], 'ads');

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
            'status' => AdStatus::PENDING->value,
            'started_at' => $data['start_date'],
            'expired_at' => $data['end_date'],
            'seller_name' => $data['seller_name'],
            'seller_email' => $data['seller_email'],
            'seller_mobile' => $data['seller_mobile'],
            'seller_address' => $data['seller_address'],

        ]);
    }
}
