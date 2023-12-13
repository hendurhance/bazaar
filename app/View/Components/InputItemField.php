<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputItemField extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type = 'text',
        public string $name,
        public string $label = '',
        public string $placeholder = '',
        public string $value = '',
        public bool $required = true,
        public bool $disabled = false,
        public bool $readonly = false,
    )

    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-item-field');
    }
}
