<?php

namespace App\Contracts\Types;

interface HasColor
{
    /**
     * Get color.
     * 
     * @return string
     */
    public function color(): string;

}