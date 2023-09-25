<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PayoutStatus: int implements HasAll, HasLabel, HasColor
{
    case PENDING = 0;
    case SUCCESS = 1;
    case FAILED = 2;
    
    public static function all(): array
    {
        return [
            self::PENDING,
            self::SUCCESS,
            self::FAILED,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::SUCCESS => 'Success',
            self::FAILED => 'Failed',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::SUCCESS => 'success',
            self::FAILED => 'danger',
        };
    }
}