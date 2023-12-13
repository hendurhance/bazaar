<?php

namespace App\View\Components;

use App\Enums\AdStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdStatusSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $selectedStatus,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ad-status-selectable', [
            'statuses' => AdStatus::all(),
        ]);
    }
}
