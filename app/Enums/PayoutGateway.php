<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PayoutGateway: int implements HasAll, HasColor, HasLabel
{
    case PAYSTACK = 0;
    case FLUTTERWAVE = 1;
    case BANK_TRANSFER = 2;

    public static function all(): array
    {
        return [
            self::PAYSTACK,
            self::FLUTTERWAVE,
            self::BANK_TRANSFER,
        ];
    }

    public function color(): string
    {
        return match ($this) {
            self::PAYSTACK => 'success',
            self::FLUTTERWAVE => 'warning',
            self::BANK_TRANSFER => 'primary',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PAYSTACK => 'Paystack',
            self::FLUTTERWAVE => 'Flutterwave',
            self::BANK_TRANSFER => 'Bank Transfer',
        };
    }
}