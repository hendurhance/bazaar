<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum CommentStatus: int implements HasAll, HasColor, HasLabel
{
    case PENDING = 1;
    case APPROVED = 2;
    case REJECTED = 3;

    public static function all(): array
    {
        return [
            self::PENDING,
            self::APPROVED,
            self::REJECTED,
        ];
    }

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'primary',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
        };
    }
}