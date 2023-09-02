<?php

namespace App\Contracts\Services;

interface AvatarServiceInterface
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