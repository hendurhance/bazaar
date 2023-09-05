<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasLabel;

enum PriceRange: int implements HasLabel, HasAll
{
    case ZERO_TO_A_THOUSAND = 0;
    case A_THOUSAND_TO_TEN_THOUSAND = 1;
    case TEN_THOUSAND_TO_FIFTY_THOUSAND = 2;
    case FIFTY_THOUSAND_TO_HUNDRED_THOUSAND = 3;
    case HUNDRED_THOUSAND_TO_FIVE_HUNDRED_THOUSAND = 4;
    case FIVE_HUNDRED_THOUSAND_TO_A_MILLION = 5;
    case A_MILLION_TO_TEN_MILLION = 6;
    case TEN_MILLION_AND_ABOVE = 7;

   /**
    * Get the label for the enum value.
    */
    public function label(): string
    {
        return match ($this) {
            self::ZERO_TO_A_THOUSAND => '0 - 1,000',
            self::A_THOUSAND_TO_TEN_THOUSAND => '1,000 - 10,000',
            self::TEN_THOUSAND_TO_FIFTY_THOUSAND => '10,000 - 50,000',
            self::FIFTY_THOUSAND_TO_HUNDRED_THOUSAND => '50,000 - 100,000',
            self::HUNDRED_THOUSAND_TO_FIVE_HUNDRED_THOUSAND => '100,000 - 500,000',
            self::FIVE_HUNDRED_THOUSAND_TO_A_MILLION => '500,000 - 1,000.,000',
            self::A_MILLION_TO_TEN_MILLION => '1,000,000 - 10.000,000',
            self::TEN_MILLION_AND_ABOVE => '10,000,000+',
        };
    }

    /**
     * Get all the values.
     */
    public static function all(): array
    {
        return [
            self::ZERO_TO_A_THOUSAND,
            self::A_THOUSAND_TO_TEN_THOUSAND,
            self::TEN_THOUSAND_TO_FIFTY_THOUSAND,
            self::FIFTY_THOUSAND_TO_HUNDRED_THOUSAND,
            self::HUNDRED_THOUSAND_TO_FIVE_HUNDRED_THOUSAND,
            self::FIVE_HUNDRED_THOUSAND_TO_A_MILLION,
            self::A_MILLION_TO_TEN_MILLION,
            self::TEN_MILLION_AND_ABOVE,
        ];
    }
}
    