<?php

namespace App\View\Components;

use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Services\Payout\BankCodeService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterAdminPayoutMethodCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CountryRepositoryInterface $countryRepository, protected BankCodeService $bankCodeService)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-admin-payout-method-card', [
            'bankCodes' => $this->bankCodeService->listBankCodes(['name', 'code']),
            'countries' => $this->countryRepository->all(),
        ]);
    }
}
