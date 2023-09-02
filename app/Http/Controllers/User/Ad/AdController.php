<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;
use App\Repositories\Auth\AuthenticateRepository;
use Intervention\Image\Facades\Image;

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
     */
    public function store(CreateAdRequest $request)
    {
        return $this->adRepository->create($this->authRepository->user(), $request->validated());
    }
}
