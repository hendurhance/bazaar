<?php

namespace App\Traits;


trait HasPayoutToken
{
    /**
     * Boot HasPayoutToken trait
     */
    protected static function bootHasPayoutToken(): void
    {
        static::creating(function ($model) {
            $model->pyt_token = generate_payout_token('BZRPYT');
        });
    }
}