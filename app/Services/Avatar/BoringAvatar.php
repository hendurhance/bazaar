<?php

namespace App\Services\Avatar;

use App\Abstracts\BaseAvatarService;
use InvalidArgumentException;

class BoringAvatar extends BaseAvatarService
{
    protected string $apiUrl = 'https://boring-avatars-api.vercel.app/api/avatar';

    protected int $size = 98;

    protected array $variants = ['marble', 'beam', 'pixel', 'sunset', 'ring', 'bauhaus'];

    protected string $variant = 'marble';

    /**
     * Generate a new avatar.
     * 
     * @return void
     */
    public function generate(): void
    {
        $this->url = "{$this->apiUrl}?size={$this->size}&variant={$this->variant}&name={$this->key}";
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

    /**
     * Set the avatar variant.
     * 
     * @param string $variant
     * @return self
     */
    public function setVariant(string $variant): self
    {
        if (!in_array($variant, $this->variants)) {
            throw new InvalidArgumentException("Invalid variant: {$variant}");
        }

        $this->variant = $variant;

        return $this;
    }
}