<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Get all of the owning mediaable models (ad or post).
     */
    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
}
