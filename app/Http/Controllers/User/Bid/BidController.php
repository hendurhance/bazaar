<?php

namespace App\Http\Controllers\User\Bid;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\BidRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateBidRequest;
use App\Http\Requests\Bid\FilterUserBidRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BidController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected BidRepositoryInterface $bidRepository, protected AuthenticateRepositoryInterface $authRepository)
    {}

    /**
     * Get all bids for the user
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterUserBidRequest $query): View
    {
        return view('bids.user.index', [
            'bids' => $this->bidRepository->getUserBids($this->authRepository->user(), 10, $query->validated()),
        ]);
    }

    /**
     * Bid on an ad.
     * @param string $ad
     * @param CreateBidRequest $request
     * @return RedirectResponse
     */
    public function bid(string $ad, CreateBidRequest $request): RedirectResponse
    {
        $this->bidRepository->bid($ad, $this->authRepository->user(), $request->validated());
        return redirect()->route('auction-details', $ad)->with('success', 'Your bid has been placed successfully.');
    }

    /**
     * Show bid details. 
     * {@inheritDoc} Show Bid for Payment
     * 
     * @param string $bid
     * @return \Illuminate\Contracts\View\View
     * 
     */
    public function show(string $bid): View
    {
        return view('bids.user.show', [
            'bid' => $this->bidRepository->getUserBid($bid, $this->authRepository->user()),
        ]);
    }
    
    /**
     * Accept bid
     * 
     * @param string $adSlug
     * @param string $bidId
     */
    public function acceptBid(string $adSlug, string $bidId): RedirectResponse
    {
        $this->bidRepository->acceptBid($adSlug, $bidId, $this->authRepository->user());
        return redirect()->back()->with('success', 'Bid accepted successfully.');
    }
}
