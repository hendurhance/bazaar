<?php

namespace App\View\Components;

use App\Contracts\Repositories\TagRepositoryInterface;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PostTagCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected TagRepositoryInterface $tagRepository)
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-tag-card', [
            'tags' => $this->tagRepository->getAllTags(true),
        ]);
    }
}
