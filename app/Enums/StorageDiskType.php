<?php

namespace App\Enums;

use App\Contracts\Types\HasLabel;

enum StorageDiskType: int implements HasLabel
{
    case LOCAL = 0;
    case S3 =  1;

    /**
     * Get the label for the enum value.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::LOCAL => 'Local',
            self::S3 => 'S3'
        };
    }
}