<?php

namespace App\View\Components;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoriesCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories-card', [
            'categories' => $this->categoryRepository->getPrimaryCategories(),
        ]);
    }
}
