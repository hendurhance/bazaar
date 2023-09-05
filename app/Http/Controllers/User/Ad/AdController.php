<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;
use App\Http\Requests\Ad\FilterAdRequest;
use App\Repositories\Auth\AuthenticateRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdRepositoryInterface $adRepository, protected AuthenticateRepository $authRepository)
    {}
    
    /**
     * Index page for listing ads.
     * 
     * @param \App\Http\Requests\Ad\FilterAdsRequest $request
     * @return \Illuminate\View\View
     */
    public function index(FilterAdRequest $request)
    {
        return view('pages.live-auction.index', [
            'ads' => $this->adRepository->getLatestAds(12, 'active', $request->validated()),
        ]);
    }

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
