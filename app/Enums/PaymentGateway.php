<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasColor;
use App\Contracts\Types\HasLabel;

enum PaymentGateway: int implements HasAll, HasColor, HasLabel
{
    case STRIPE = 0;
    case PAYSTACK = 1;
    case FLUTTERWAVE = 2;

    public static function all(): array
    {
        return [
            self::STRIPE,
            self::PAYSTACK,
            self::FLUTTERWAVE,
        ];
    }

    public function color(): string
    {
        return match ($this) {
            self::STRIPE => 'primary',
            self::PAYSTACK => 'success',
            self::FLUTTERWAVE => 'warning',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::STRIPE => 'Stripe',
            self::PAYSTACK => 'Paystack',
            self::FLUTTERWAVE => 'Flutterwave',
        };
    }
}