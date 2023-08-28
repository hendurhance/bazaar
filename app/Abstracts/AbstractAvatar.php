<?php

namespace App\Abstracts;

use App\Contracts\Services\AvatarInterface;

abstract class AbstractAvatar implements AvatarInterface
{
    /**
     * The key to generate the avatar. <email|name>
     * @var string
     */
    protected string $key;

    /**
     * The avatar url.
     * 
     * @var string
     */
    protected string $url;
    
    /**
     * Initialize the avatar.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->generate();
    }

    /**
     * Generate a new avatar.
     * @return void
     */
    abstract public function generate(): void;

    /**
     * Get the avatar url.
     * 
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}