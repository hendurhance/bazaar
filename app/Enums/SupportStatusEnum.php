<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum SupportStatusEnum: int implements HasAll, HasLabel, HasColor
{
    case PENDING = 0;
    case RESOLVED = 1;
    
    public static function all(): array
    {
        return [
            self::PENDING,
            self::RESOLVED,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::RESOLVED => 'Resolved',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::RESOLVED => 'success',
        };
    }
}