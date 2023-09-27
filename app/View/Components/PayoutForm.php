<?php

namespace App\View\Components;

use App\Contracts\Repositories\PayoutMethodRepositoryInterface;
use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PayoutForm extends Component
{
    protected float $feePercentage;

    /**
     * Create a new component instance.
     */
    public function __construct(
        protected User $user, 
        public float $amount, 
        protected PayoutMethodRepositoryInterface $payoutMethodRepository,
        public string $txnId,
    )
    {
        $this->feePercentage = config('payment.payout.fee');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.payout-form',
            [
                'payoutMethods' => $this->payoutMethodRepository->getUserPayoutMethods($this->user),
                'feePercentage' => $this->feePercentage,
                'netAmount' => $this->calculateNetAmount(),
            ]
        );
    }

    /**
     * Calculate the 
     */
    public function calculateNetAmount(): float
    {
        return $this->amount - ($this->amount * ($this->feePercentage / 100));
    }
}
