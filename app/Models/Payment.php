<?php

namespace App\Models;

use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use App\Traits\HasTransactionID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory, HasTransactionID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'ad_id',
        'payer_id',
        'payee_id',
        'bid_id',
        'amount',
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
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'status' => PaymentStatus::class,
        'gateway' => PaymentGateway::class,
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
     * Get the user that paid for the ad.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    /**
     * Get the user that received the payment.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payee_id');
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

    /**
     * Payment is paid
     * 
     */
    public function paid(): bool
    {
        return $this->status === PaymentStatus::SUCCESS;
    }
}
