<?php

namespace App\Traits;

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
        $slug = $this->slugify($this->title ?? $this->name);

        $latestSlug =
            static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")
                ->latest('id')
                ->value('slug');

        if ($latestSlug) {
            $pieces = explode('-', $latestSlug);

            $number = intval(end($pieces));

            $slug .= '-' . ($number + 1);
        }

        return $slug;
    }

    /**
     * Slugify the given string
     * @param string $text
     * @return string
     */
    protected function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        $text = preg_replace('~[^-\w]+~', '', $text);

        $text = trim($text, '-');

        $text = preg_replace('~-+~', '-', $text);

        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}