<?php

namespace App\Traits;


trait HasNameSplit
{
    /**
     * Get the user's first name.
     * @return string
     */
    public function getFirstNameAttribute(): string
    {
        return implode(' ', array_slice(explode(' ', $this->name), 0, count(explode(' ', $this->name)) / 2)) ?? '';
    }

    /**
     * Get the user's last name.
     * @return string
     */
    public function getLastNameAttribute(): string
    {
        return implode(' ', array_slice(explode(' ', $this->name), count(explode(' ', $this->name)) / 2)) ?? '';
    }
}
