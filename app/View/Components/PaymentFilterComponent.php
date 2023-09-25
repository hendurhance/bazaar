<?php

namespace App\View\Components;

use App\Enums\PaymentGateway;
use App\Enums\PaymentStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentFilterComponent extends Component
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
        return view('components.payment-filter-component',[
            'statuses' => PaymentStatus::all(),
            'gateways' => PaymentGateway::all(),
        ]);
    }
}
