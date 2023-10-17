<?php

namespace App\Traits;

use App\Services\Avatar\UIAvatar;

trait HasAvatar
{
    /**
     * Boot HasAvatar trait
     */
    protected static function bootHasAvatar(): void
    {
        static::creating(function ($model) {
            $model->avatar = (new UIAvatar($model->name))->getUrl();
        });
    }
}