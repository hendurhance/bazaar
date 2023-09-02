<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasSlug;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ad extends Model
{
    use HasFactory, HasMedia, HasSlug, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'user_id',
        'title',
        'description',
        'price',
        'is_negotiable',
        'video_url',
        'seller_name',
        'seller_email',
        'seller_mobile',
        'seller_address',
        'mark_as_urgent',
        'status',
        'started_at',
        'expired_at',
        'views',
        'country_id',
        'state_id',
        'city_id',
        'media_ids',
    ];

    /**
     * Get the category that owns the ad.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the sub category that owns the ad.
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id');
    }

    /**
     * Get the user that owns the ad.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the country that owns the ad.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the state that owns the ad.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city that owns the ad.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'media_ids' => 'array',
        'is_negotiable' => 'boolean',
        'mark_as_urgent' => 'boolean',
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     * 
     * @var array
     */
    protected $dates = [
        'started_at',
        'expired_at',
    ];

    /**
     * The attributes that should be appended.
     * 
     * @var array
     */
    protected $appends = [
        'media',
    ];
}


