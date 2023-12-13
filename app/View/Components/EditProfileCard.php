<?php

namespace App\View\Components;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditProfileCard extends Component
{
     /**
     * Create a new component instance.
     */
    public function __construct(protected AuthenticateRepositoryInterface $authenticateRepository)
    {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-profile-card', [
            'admin' => $this->authenticateRepository->admin(),
        ]);
    }
}
