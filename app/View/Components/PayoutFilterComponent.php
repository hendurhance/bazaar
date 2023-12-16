<?php

namespace App\View\Components;

use App\Enums\PayoutGateway;
use App\Enums\PayoutStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PayoutFilterComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payout-filter-component', [
            'statuses' => PayoutStatus::all(),
            'gateways' => PayoutGateway::all(),
        ]);
    }
}
