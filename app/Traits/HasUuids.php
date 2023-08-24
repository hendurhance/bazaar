<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuids
{
    /**
     * Boot uuid trait.
     */
    protected static function bootHasUuids(): void
    {
        static::creating(function ($model) {
            $model->id = (string) Str::orderedUuid();
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the primary key for the model.
     */
    public function getKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the casted primary key.
     */
    public function getKeyType(): string
    {
        return 'string';
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public function getIncrementing(): bool
    {
        return false;
    }
}