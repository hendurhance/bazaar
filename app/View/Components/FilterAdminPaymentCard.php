<?php

namespace App\View\Components;

use App\Enums\PaymentGateway;
use App\Enums\PriceRange;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterAdminPaymentCard extends Component
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
        return view('components.filter-admin-payment-card', [
            'priceRanges' => PriceRange::all(),
            'gateways' => PaymentGateway::all(),
        ]);
    }
}
