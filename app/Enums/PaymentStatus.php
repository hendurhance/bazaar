<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PaymentStatus: int implements HasAll, HasLabel, HasColor
{
    case INITIATED = 0;
    case PENDING = 1;
    case SUCCESS = 2;
    case FAILED = 3;
    case DECLINED = 4;
    case DISPUTE = 5;

    public static function all(): array
    {
        return [
            self::INITIATED,
            self::PENDING,
            self::SUCCESS,
            self::FAILED,
            self::DECLINED,
            self::DISPUTE,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::INITIATED => 'Initiated',
            self::PENDING => 'Pending',
            self::SUCCESS => 'Success',
            self::FAILED => 'Failed',
            self::DECLINED => 'Declined',
            self::DISPUTE => 'Dispute',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::INITIATED => 'secondary',
            self::PENDING => 'primary',
            self::SUCCESS => 'success',
            self::FAILED => 'danger',
            self::DECLINED => 'warning',
            self::DISPUTE => 'info',
        };
    }
}