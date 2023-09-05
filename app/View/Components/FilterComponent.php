<?php

namespace App\View\Components;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Enums\PriceRange;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FilterComponent extends Component
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
        return view('components.filter-component', [
            'categories' => $this->categoryRepository->getPrimaryCategories(),
            'countries' => $this->countryRepository->all(),
            'priceRanges' => PriceRange::all(),
        ]);
    }
}
