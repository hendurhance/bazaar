<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PaymentGateway: int implements HasAll, HasColor, HasLabel
{
    case PAYSTACK = 0;
    case FLUTTERWAVE = 1;

    public static function all(): array
    {
        return [
            self::PAYSTACK,
            self::FLUTTERWAVE,
        ];
    }

    public function color(): string
    {
        return match ($this) {
            self::PAYSTACK => 'success',
            self::FLUTTERWAVE => 'warning',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::PAYSTACK => 'Paystack',
            self::FLUTTERWAVE => 'Flutterwave',
        };
    }
}