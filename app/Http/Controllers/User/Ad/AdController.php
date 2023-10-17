<?php

namespace App\Http\Controllers\User\Ad;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\CreateAdRequest;
use App\Http\Requests\Ad\FilterAdRequest;
use App\Http\Requests\Ad\FilterUserAdsRequest;
use App\Http\Requests\Ad\ReportAdRequest;
use App\Http\Requests\Ad\UpdateAdRequest;
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
     * @param \App\Http\Requests\Ad\FilterAdsRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdRequest $query): View
    {
        return view('pages.live-auction.index', [
            'ads' => $this->adRepository->getLatestAds(12, 'active', $query->validated()),
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
     * Get user ads.
     * 
     * @return \Illuminate\View\View
     */
    public function userAds(FilterUserAdsRequest $query): View
    {
        return view('ads.user.index', [
            'ads' => $this->adRepository->getUserAds($this->authRepository->user(), 10, $query->validated()),
        ]);
    }

    /**
     * Show user ad details.
     * 
     * @param string $ad
     * @return \Illuminate\View\View
     */
    public function showUserAd(string $ad): View
    {
        return view('ads.user.show', [
            'ad' => $this->adRepository->getUserAd($this->authRepository->user(), $ad),
        ]);
    }

    /**
     * Edit user ad.
     * 
     * @param string $ad
     * @return \Illuminate\View\View
     */
    public function editUserAd(string $ad): View
    {
        return view('ads.user.edit', [
            'ad' => $this->adRepository->getUserAd($this->authRepository->user(), $ad),
        ]);
    }

    /**
     * Update user ad.
     * 
     * @param string $ad
     * @param \App\Http\Requests\Ad\UpdateAdRequest $request
     */
    public function updateUserAd(string $ad, UpdateAdRequest $request): RedirectResponse
    {
        $this->adRepository->updateUserAd($this->authRepository->user(), $ad, $request->validated());
        return redirect()->route('user.ads')->with('success', 'Your ad has been updated successfully.');
    }

    /**
     * Report ad.
     * 
     * @param string $ad
     * @return \Illuminate\View\View
     */
    public function report(string $ad): View
    {
        return view('pages.live-auction.report', [
            'ad' => $this->adRepository->getAd($ad),
        ]);
    }

    /**
     * Handle ad report.
     * 
     * @param string $ad
     * @param \App\Http\Requests\Ad\ReportAdRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleReport(string $ad, ReportAdRequest $request): RedirectResponse
    {
        $this->adRepository->reportAd($ad, $request->validated());
        return redirect()->route('auction-details', $ad)->with('success', 'Your report has been submitted successfully.');
    }
}
