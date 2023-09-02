<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMedia
{
    /**
     * Get the model's media.
     */
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable');
    }
}