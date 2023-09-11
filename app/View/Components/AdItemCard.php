<?php

namespace App\View\Components;

use App\Models\Ad;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdItemCard extends Component
{
    protected array $types = [
        'classic',
        'slider',
        'default',
        'small'
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(protected Ad $ad, protected string $type)
    {
        if (!in_array($this->type, $this->types)) {
            throw new \Exception('Invalid ad item card type.');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ad-item-card', [
            'ad' => $this->ad,
            'type' => $this->type
        ]);
    }
}
