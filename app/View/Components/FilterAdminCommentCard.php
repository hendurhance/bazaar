<?php

namespace App\View\Components;

use App\Enums\CommentStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterAdminCommentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.filter-admin-comment-card', [
            'statuses' => CommentStatus::all()
        ]);
    }
}
