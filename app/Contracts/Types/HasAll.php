<?php

namespace App\Contracts\Types;

interface HasAll
{
    /**
     * Get all labels.
     * 
     * @return array
     */
    public static function all(): array;
}