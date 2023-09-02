<?php

namespace App\Services\Avatar;

use App\Abstracts\BaseAvatarService;

class Gravatar extends BaseAvatarService
{
    protected string $apiUrl = 'https://www.gravatar.com/avatar';

    protected int $size = 96;

    /**
     * Generate a new avatar.
     * 
     * @param string $key <email|name>
     * @return void
     */
    public function generate(): void
    {
        $this->url = "{$this->apiUrl}/" . md5(strtolower(trim($this->key))) . "?s={$this->size}";
    }


    /**
     * Set the avatar size.
     * 
     * @param int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }
}