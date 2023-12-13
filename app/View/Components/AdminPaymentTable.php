<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminPaymentTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public LengthAwarePaginator $payments)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-payment-table', ['payments' => $this->payments]);
    }
}
