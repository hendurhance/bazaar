<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;
use App\Http\Requests\Ad\CreateBidRequest;
use App\Http\Requests\Ad\FilterAdRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdRepositoryInterface $adRepository, protected AuthenticateRepositoryInterface $authRepository)
    {}
    
    /**
     * Index page for listing ads.
     * 
     * @param \App\Http\Requests\Ad\FilterAdsRequest $request
     * @return \Illuminate\View\View
     */
    public function index(FilterAdRequest $request): View
    {
        return view('pages.live-auction.index', [
            'ads' => $this->adRepository->getLatestAds(12, 'active', $request->validated()),
        ]);
    }

    /**
     * Show ad details.
     * 
     * @param string $ad
     * @return \Illuminate\View\View
     */
    public function show(string $ad): View
    {
        return view('pages.live-auction.show', [
            'ad' => $this->adRepository->getAd($ad),
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

    /**
     * Bid on an ad.
     * @param string $ad
     * @param CreateBidRequest $request
     * @return RedirectResponse
     */
    public function bid(string $ad, CreateBidRequest $request): RedirectResponse
    {
        $this->adRepository->bid($ad,$this->authRepository->user(), $request->validated());
        return redirect()->route('auction-details', $ad)->with('success', 'Your bid has been placed successfully.');
    }

    /**
     * Get user ads.
     * 
     * @return \Illuminate\View\View
     */
    public function ads(): View
    {
        return view('bids.user.index', [
            'ads' => $this->adRepository->getUserAds($this->authRepository->user()),
        ]);
    }
}
