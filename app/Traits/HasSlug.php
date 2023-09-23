<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot HasSlug trait
     */
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            $model->slug = $model->generateSlug();
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') || $model->isDirty('name')) {
                $model->slug = $model->generateSlug();
            }
        });
    }

    /**
     * Generate a unique slug for this model
     * @return string
     */
    protected function generateSlug(): string
    {
        $slug = Str::slug($this->title ?? $this->name);

        $latestSlug =
            static::whereRaw("slug = '{$slug}'")
                ->latest('id')
                ->value('slug');

        if ($latestSlug) {
            $slug .= '-' . uniqid();
        }

        return $slug;
    }
}