<?php

namespace App\Services\Avatar;

use App\Abstracts\BaseAvatarService;

class UIAvatar extends BaseAvatarService
{
    protected string $apiUrl = 'https://ui-avatars.com';

    protected array $formats = [
        'png',
        'jpg'
    ];

    protected bool $rounded = false;

    protected int $size = 96; // 96px

    protected string $background;

    protected string $color;

    /**
     * Initialize the avatar.
     */
    public function __construct(string $key)
    {
        $this->background = str_replace('#', '', generate_color('hex'));
        $this->color = str_replace('#', '', generate_color('hex'));
        parent::__construct($key);
    }

    /**
     * Generate a new avatar.
     * 
     * @return void
     */
    public function generate(): void
    {
        $this->url = "{$this->apiUrl}/api/?name=" . urlencode($this->key) . "&size={$this->size}&background={$this->background}&color={$this->color}&rounded={$this->rounded}";
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
     * Set the avatar background color.
     * 
     * @param string $color
     * @return self
     */
    public function setBackground(string $color): self
    {
        $this->background = $color;

        return $this;
    }

    /**
     * Set the avatar text color.
     * 
     * @param string $color
     * @return self
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
