<?php

namespace App\Contracts\Services;

interface AvatarInterface
{
    /**
     * Generate a new avatar.
     * @return void
     */
    public function generate(): void;

    /**
     * Get the avatar url.
     * 
     * @return string
     */
    public function getUrl(): string;
}