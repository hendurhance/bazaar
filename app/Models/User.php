<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Gender;
use App\Traits\HasAvatar;
use App\Traits\HasNameSplit;
use App\Traits\HasUuids;
use App\Traits\HasVerifiedEmail;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, HasAvatar, HasVerifiedEmail, HasNameSplit;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'mobile',
        'gender',
        'email_verification_token',
        'email_verified_at',
        'password',
        'address',
        'zip_code',
        'avatar',
        'country_id',
        'state_id',
        'city_id',
        'timezone_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'gender' => Gender::class,
    ];

    /**
     * Username Attribute.
     * 
     * @return Attribute
     */
    public function username(): Attribute
    {
        return Attribute::make(
            fn ($value) => strtolower($value),
            fn ($value) => strtolower($value)
        );
    }

    /**
     * Scope a query to only include active users.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include inactive users.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    /**
     * Get the ads for the user.
     */
    public function ads(): HasMany
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Get the bids for the user.
     */
    public function bids(): HasMany
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Get the payments the user paid
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payer_id');
    }

    /**
     * Get the payments the user received
     */
    public function receivedPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'payee_id');
    }

    /**
     * Get payouts for the user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class, 'user_id');
    }

    /**
     * Get the payout methods for the user.
     */
    public function payoutMethods(): HasMany
    {
        return $this->hasMany(PayoutMethod::class);
    }

    /**
     * Get the accepted bids for the user.
     */
    public function acceptedBids(): HasMany
    {
        return $this->hasMany(Bid::class)->where('is_accepted', true);
    }

    /**
     * Get the country the user belongs to.
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the country the user belongs to.
     */
    public function timezone(): BelongsTo
    {
        return $this->belongsTo(Timezone::class);
    }


    /**
     * Get the state the user belongs to.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Get the city the user belongs to.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
