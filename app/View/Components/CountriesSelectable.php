<?php

namespace App\View\Components;

use App\Contracts\Repositories\CountryRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CountriesSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CountryRepositoryInterface $countryRepository)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.countries-selectable', [
            'countries' => $this->countryRepository->all(),
        ]);
    }
}