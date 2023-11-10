<?php

namespace App\Models;

use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayoutMethod extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'country_id',
        'bank_name',
        'bank_code',
        'account_name',
        'account_number',
        'swift_code',
        'iban',
        'routing_number',
        'meta',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    /**
     * Get the user that owns the payout method.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get country that owns the payout method.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get payouts that owns the payout method.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function payouts(): HasMany
     {
         return $this->hasMany(Payout::class);
     }

}
