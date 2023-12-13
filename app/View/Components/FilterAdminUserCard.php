<?php

namespace App\View\Components;

use App\Contracts\Repositories\CountryRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterAdminUserCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-admin-user-card', [
            'countries' => $this->countryRepository->all(),
        ]);
    }
}
