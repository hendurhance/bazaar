<?php

namespace App\Contracts\Types;

interface HasLabel
{
    /**
     * Get the label for the enum value.
     *
     * @return string
     */
    public function label(): string;
}