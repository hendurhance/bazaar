<?php

namespace App\View\Components;

use App\Contracts\Repositories\TagRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogFilterComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog-filter-component', [
            'tags' => $this->tagRepository->getAllTags(),
        ]);
    }
}
