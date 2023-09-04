<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasLabel;

enum AdStatus: int implements HasLabel, HasAll
{
    case PENDING = 0;
    case PUBLISHED = 1;
    case REJECTED = 2;
    case EXPIRED = 3;
    case ARCHIVED = 4;

    /**
     * Get label.
     * 
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PUBLISHED => 'Published',
            self::REJECTED => 'Rejected',
            self::EXPIRED => 'Expired',
            self::ARCHIVED => 'Archived',
        };
    }

    /**
     * Get all labels.
     * 
     * @return array
     */
    public static function all(): array
    {
        return [
            self::PENDING,
            self::PUBLISHED,
            self::REJECTED,
            self::EXPIRED,
            self::ARCHIVED,
        ];
    }
}