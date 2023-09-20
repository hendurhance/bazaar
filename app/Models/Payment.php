<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'ad_id',
        'user_id',
        'bid_id',
        'price',
        'price',
        'method',
        'txn_id',
        'status',
        'currency',
        'token',
        'card_last4',
        'card_id',
        'client_ip',
        'payer_email',
        'gateway',
        'description'
    ];

    /**
     * Get the ad that owns the payment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ad(): BelongsTo
    {
        return $this->belongsTo(Ad::class);
    }

    /**
     * Get the user that owns the payment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the bid that owns the payment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bid(): BelongsTo
    {
        return $this->belongsTo(Bid::class);
    }
}
