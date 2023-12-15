<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use App\Enums\PayoutGateway;
use App\Enums\PayoutStatus;
use App\Traits\HasPayoutToken;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
use HasFactory, HasPayoutToken;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'payout_method_id',
        'payment_id',
        'amount',
        'fee',
        'currency',
        'pyt_token',
        'status',
        'description',
        'gateway',
        'paid_at',
        'meta'
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'fee' => 'decimal:2',
        'paid_at' => 'datetime',
        'status' => PayoutStatus::class,
        'gateway' => PayoutGateway::class,
        'meta' => 'array',
    ];

    /**
     * Get the user that owns the payout.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the payout method that owns the payout.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payoutMethod(): BelongsTo
    {
        return $this->belongsTo(PayoutMethod::class)->withDefault();
    }

    /**
     * Get the payment that owns the payout.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    /**
     * Scope a query to only include pending payments.
     */
    public function scopePending(Builder $query)
    {
        return $query->where('status', PaymentStatus::PENDING);
    }

    /**
     * Scope a query to only include failed payments.
     */
    public function scopeFailed(Builder $query)
    {
        return $query->where('status', PaymentStatus::FAILED);
    }

    /**
     * Scope a query to only include success payments.
     */
    public function scopeSuccess(Builder $query)
    {
        return $query->where('status', PaymentStatus::SUCCESS);
    }
}
