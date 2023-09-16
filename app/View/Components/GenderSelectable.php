<?php

namespace App\View\Components;

use App\Enums\Gender;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GenderSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $label, public string $name, public ?Gender $selected = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gender-selectable', [
            'gender' => Gender::all(),
        ]);
    }
}
