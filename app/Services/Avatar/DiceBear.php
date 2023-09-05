<?php

namespace App\Services\Avatar;

use App\Abstracts\BaseAvatarService;
use InvalidArgumentException;

class DiceBear extends BaseAvatarService
{
    protected string $apiUrl = 'https://api.dicebear.com';

    protected string $version = '6.x';

    protected array $styles = [
        'adventurer',
        'adventurer-neutral',
        'avataaars',
        'avataaars-neutral',
        'big-ears',
        'big-ears-neutral',
        'big-smile',
        'bottts',
        'bottts-neutral',
        'croodles',
        'croodles-neutral',
        'fun-emoji',
        'icons',
        'identicon',
        'initials',
        'lorelei',
        'lorelei-neutral',
        'micah',
        'miniavs',
        'notionists',
        'notionists-neutral',
        'open-peeps',
        'personas',
        'pixel-art',
        'pixel-art-neutral',
        'shapes',
        'thumbs'
    ];

    protected array $formats = [
        'svg',
        'png',
        'jpg'
    ];

    protected array $sizes = [
        32,
        48,
        64,
        80,
        96
    ];

    protected string $style = 'avataaars';

    protected int $size = 96; // 96px

    protected string $format = 'svg';

    /**
     * Generate a new avatar.
     * 
     * @return void
     */
    public function generate(): void
    {
        $this->url = "{$this->apiUrl}/{$this->version}/{$this->style}/{$this->format}?size={$this->size}&seed={$this->key}";
    }

    /**
     * Set the avatar style.
     * 
     * @param string $style
     * @return self
     */
    public function setStyle(string $style): self
    {
        if (!in_array($style, $this->styles)) {
            throw new InvalidArgumentException('Invalid avatar style.');
        }

        $this->style = $style;

        return $this;
    }

    /**
     * Set the avatar size.
     * 
     * @param int $size
     * @return self
     */
    public function setSize(int $size): self
    {
        if (!in_array($size, $this->sizes)) {
            throw new InvalidArgumentException('Invalid avatar size.');
        }

        $this->size = $size;

        return $this;
    }

    /**
     * Set the avatar format.
     * 
     * @param string $format
     * @return self
     */
    public function setFormat(string $format): self
    {
        if (!in_array($format, $this->formats)) {
            throw new InvalidArgumentException('Invalid avatar format.');
        }

        $this->format = $format;

        return $this;
    }
}