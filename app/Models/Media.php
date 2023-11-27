<?php

namespace App\Models;

use App\Enums\MediaType;
use App\Enums\StorageDiskType;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory, HasUuids;

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'mediaable_id',
        'mediaable_type',
        'name',
        'type',
        'path',
        'url',
        'size',
        'extension',
        'mime_type',
        'storage',
        'is_featured',
    ];



    /**
     * Get all of the owning mediaable models (ad or post).
     */
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the media.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be cast.
     * 
     * @var array
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'storage' => StorageDiskType::class,
        // 'type' => MediaType::class,
    ];
}
