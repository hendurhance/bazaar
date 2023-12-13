<?php

namespace App\Models;

use App\Enums\AdStatus;
use App\Traits\HasMedia;
use App\Traits\HasSlug;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ad extends Model
{
    use HasFactory, HasSlug, HasUuids, HasMedia;

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
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
            'username' => 'guest',
        ]);
    }

    /**
     * Get the country that owns the ad.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the state that owns the ad.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the city that owns the ad.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class)->withDefault([
            'name' => 'N/A',
        ]);
    }

    /**
     * Get the reports for the ad.
     */
    public function reports(): HasMany
    {
        return $this->hasMany(ReportAd::class);
    }

    /**
     * Get the bids for the ad.
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Get the highest bid amount for the ad.
     */
    public function highestBid(): HasOne
    {
        return $this->hasOne(Bid::class)->orderBy('amount', 'desc')->limit(1);
    }

    /**
     * Get the winning bid for the ad.
     */
    public function winningBid(): HasOne
    {
        return $this->hasOne(Bid::class)->where('is_accepted', true);
    }


    /**
     * Get related ads.
     */
    public function relatedAds(): HasMany
    {
        return $this->hasMany(Ad::class, 'category_id', 'category_id')
            ->where('id', '!=', $this->id)
            ->active()
            ->limit(4);
    }

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'is_negotiable' => 'boolean',
        'mark_as_urgent' => 'boolean',
        'started_at' => 'datetime',
        'expired_at' => 'datetime',
        'status' => AdStatus::class,
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
     * Ad Model Methods
     * 
     */
    public function active(): bool
    {
        return $this->started_at->isPast() && $this->expired_at->isFuture() && $this->status === AdStatus::PUBLISHED;
    }

    public function upcoming(): bool
    {
        return $this->started_at->isFuture() && $this->status === AdStatus::PUBLISHED;
    }

    public function expired(): bool
    {
        return $this->expired_at->isPast() && $this->status === AdStatus::PUBLISHED;
    }

    public function rejected(): bool
    {
        return $this->status === AdStatus::REJECTED;
    }

    public function pending(): bool
    {
        return $this->status === AdStatus::PENDING;
    }

    /**
     * Scope a query to only include active ads.
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereDate('started_at', '<=', now())
            ->whereDate('expired_at', '>=', now())
            ->where('status', AdStatus::PUBLISHED);
    }

    /**
     * Scope a query to include pending ads.
     */
    public function scopePending(Builder $query)
    {
        return $query->where('status', AdStatus::PENDING);
    }

    /**
     * Scope a query to only include upcoming ads.
     */
    public function scopeUpcoming(Builder $query)
    {
        return $query->whereDate('started_at', '>', now())
            ->where('status', AdStatus::PUBLISHED);
    }

    /**
     * Scope a query to only include expired ads.
     */
    public function scopeExpired(Builder $query)
    {
        return $query->whereDate('expired_at', '<', now())
            ->where('status', AdStatus::EXPIRED);
    }

    /**
     * Scope a query to only include rejected ads.
     */
    public function scopeRejected(Builder $query)
    {
        return $query->where('status', AdStatus::REJECTED);
    }
    
    /**
     * Check if ad has an accepted bid
     */
    public function hasAcceptedBid(): bool
    {
        return $this->bids()->where('is_accepted', true)->exists();
    }

}


