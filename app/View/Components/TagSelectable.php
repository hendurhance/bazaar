<?php

namespace App\View\Components;

use App\Contracts\Repositories\TagRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TagSelectable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected TagRepositoryInterface $tagRepository, public ?Collection $selectedTags)
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tag-selectable', [
            'tags' => $this->tagRepository->getAllTags(),
            'selectedTags' => $this->selectedTags,
        ]);
    }
}
