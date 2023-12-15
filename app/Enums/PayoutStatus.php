<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PayoutStatus: int implements HasAll, HasLabel, HasColor
{
    case PENDING = 0;
    case PROCESSING = 1;
    case SUCCESS = 2;
    case FAILED = 3;
    case REVERSED = 4;
    
    public static function all(): array
    {
        return [
            self::PENDING,
            self::PROCESSING,
            self::SUCCESS,
            self::FAILED,
            self::REVERSED,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::SUCCESS => 'Success',
            self::FAILED => 'Failed',
            self::REVERSED => 'Reversed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::PROCESSING => 'secondary',
            self::SUCCESS => 'success',
            self::FAILED => 'danger',
            self::REVERSED => 'warning',
        };
    }
}