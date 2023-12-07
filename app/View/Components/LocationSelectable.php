<?php

namespace App\View\Components;

use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Models\Country;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LocationSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CountryRepositoryInterface $countryRepository, public Country $selectedCountry)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.location-selectable', [
            'countries' => $this->countryRepository->all(),
        ]);
    }
}
