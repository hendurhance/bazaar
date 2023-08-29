<?php

namespace App\View\Components;

use App\Contracts\Repositories\CountryRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PhoneSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected CountryRepositoryInterface $countryRepository,
        public string $name = 'phone',
        public string $label = 'Phone',
        public string $placeholder = 'Phone',
        public string $value = '',
        public bool $required = true
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.phone-selectable', [
            'countries' => $this->countryRepository->getCallingCode(),
        ]);
    }
}
