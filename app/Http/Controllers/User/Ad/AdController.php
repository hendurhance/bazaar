<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdRepositoryInterface $adRepository)
    {}

    /**
     * Create an ad listing.
     * 
     * @param \App\Http\Requests\Ad\CreateAdRequest $request
     */
    public function store(CreateAdRequest $request)
    {
        $this->adRepository->create(null ,$request->validated());
    }
}
