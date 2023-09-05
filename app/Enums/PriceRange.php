<?php

namespace App\Enums;

use App\Contracts\Types\HasAll;
use App\Contracts\Types\HasLabel;

enum PriceRange: int implements HasLabel, HasAll
{
    case ALL = 0;
    case ZERO_TO_A_THOUSAND = 1;
    case A_THOUSAND_TO_TEN_THOUSAND = 2;
    case TEN_THOUSAND_TO_FIFTY_THOUSAND = 4;
    case FIFTY_THOUSAND_TO_HUNDRED_THOUSAND = 5;
    case HUNDRED_THOUSAND_TO_FIVE_HUNDRED_THOUSAND = 6;
    case FIVE_HUNDRED_THOUSAND_TO_A_MILLION = 7;
    case A_MILLION_TO_TEN_MILLION = 8;
    case TEN_MILLION_AND_ABOVE = 9;

   /**
    * Get the label for the enum value.
    */
    public function label(): string
    {
        return match ($this) {
            self::ALL => 'All Prices',
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
            self::ALL,
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

    /**
     * Get the query range for the enum value.
     * @param int $value
     */
    public static function range(int $value): array
    {
        return match ($value) {
            self::ALL->value => [0, 1000000000],
            self::ZERO_TO_A_THOUSAND->value => [0, 1000],
            self::A_THOUSAND_TO_TEN_THOUSAND->value => [1000, 10000],
            self::TEN_THOUSAND_TO_FIFTY_THOUSAND->value => [10000, 50000],
            self::FIFTY_THOUSAND_TO_HUNDRED_THOUSAND->value => [50000, 100000],
            self::HUNDRED_THOUSAND_TO_FIVE_HUNDRED_THOUSAND->value => [100000, 500000],
            self::FIVE_HUNDRED_THOUSAND_TO_A_MILLION->value => [500000, 1000000],
            self::A_MILLION_TO_TEN_MILLION->value => [1000000, 10000000],
            self::TEN_MILLION_AND_ABOVE->value => [10000000, 1000000000],
        };
    }
}
    