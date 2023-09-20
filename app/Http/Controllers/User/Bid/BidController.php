<?php

namespace App\Http\Controllers\User\Bid;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\BidRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateBidRequest;
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
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('bids.user.index', [
            'bids' => $this->bidRepository->getUserBids($this->authRepository->user(), 10)
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
        $this->bidRepository->bid($ad,$this->authRepository->user(), $request->validated());
        return redirect()->route('auction-details', $ad)->with('success', 'Your bid has been placed successfully.');
    }
}
