<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;
use App\Repositories\Auth\AuthenticateRepository;
use Illuminate\Http\RedirectResponse;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdRepositoryInterface $adRepository, protected AuthenticateRepository $authRepository)
    {}

    /**
     * Create an ad listing.
     * 
     * @param \App\Http\Requests\Ad\CreateAdRequest $request
     * @return RedirectResponse;
     */
    public function store(CreateAdRequest $request): RedirectResponse
    {
        $this->adRepository->create($this->authRepository->user(), $request->validated());
        return redirect()->route('add-listing')->with('success', 'Your ad has been created successfully, it will be reviewed by our team before it is published.');
    }
}
