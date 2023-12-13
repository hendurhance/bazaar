<?php

namespace App\Models;

use App\Enums\SupportStatusEnum;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Support extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'status',
        'assigned_to',
        'response'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<int, string>
     */
    protected $casts = [
        'status' => SupportStatusEnum::class
    ];

    /**
     * Get the admin that is assigned to the support ticket.
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }


    /**
     * Scope a query to only include pending tickets.
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', SupportStatusEnum::PENDING);
    }

    /**
     * Scope a query to only include resolved tickets.
     */
    public function scopeResolved(Builder $query): Builder
    {
        return $query->where('status', SupportStatusEnum::RESOLVED);
    }
}
