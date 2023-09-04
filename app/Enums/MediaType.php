<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasLabel;

enum MediaType: int implements HasLabel, HasAll
{
    case IMAGE = 0;
    case FILE = 1;
    case VIDEO = 2;
    case OTHER = 3;

    /**
     * Get label.
     * 
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::IMAGE => 'Image',
            self::FILE => 'File',
            self::VIDEO => 'Video',
            self::OTHER => 'Other',
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
            self::IMAGE,
            self::FILE,
            self::VIDEO,
            self::OTHER,
        ];
    }
}