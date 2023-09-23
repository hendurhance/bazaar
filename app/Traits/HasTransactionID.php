<?php

namespace App\Traits;


trait HasTransactionID
{
    /**
     * Boot HasTransactionID trait
     */
    protected static function bootHasTransactionID(): void
    {
        static::creating(function ($model) {
            $model->txn_id = generate_txn_id('BZR');
        });
    }
}