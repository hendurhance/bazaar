<?php

namespace App\View\Components;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Enums\PriceRange;
use App\Http\Requests\Ad\FilterAdRequest;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdFilterComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository, protected CountryRepositoryInterface $countryRepository)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ad-filter-component', [
            'categories' => $this->categoryRepository->getPrimaryCategories(),
            'countries' => $this->countryRepository->all([ 'id', 'name', 'iso2' ]),
            'priceRanges' => PriceRange::all(),
        ]);
    }
}
