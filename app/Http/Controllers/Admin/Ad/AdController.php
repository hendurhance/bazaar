<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Contracts\Repositories\AdminAdRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\FilterAdminAdsRequest;
use App\Http\Requests\Ad\UpdateAdAdminRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AdController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminAdRepositoryInterface $adminAdRepository)
    {
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminAdsRequest $query): View
    {
        return view('ads.admin.index', [
            'ads' => $this->adminAdRepository->getAds(10, 'all', $query->validated())
        ]);
    }

    /**
     * Display a pending of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function pending(FilterAdminAdsRequest $query): View
    {
        return view('ads.admin.status.pending', [
            'ads' => $this->adminAdRepository->getAds(10, 'pending', $query->validated())
        ]);
    }

    /**
     * Display a active of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function active(FilterAdminAdsRequest $request): View
    {
        return view('ads.admin.status.active', [
            'ads' => $this->adminAdRepository->getAds(10, 'active', $request->validated())
        ]);
    }

    /**
     * Display a upcoming of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function upcoming(FilterAdminAdsRequest $request): View
    {
        return view('ads.admin.status.upcoming', [
            'ads' => $this->adminAdRepository->getAds(10, 'upcoming', $request->validated())
        ]);
    }

    /**
     * Display a expired of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function expired(FilterAdminAdsRequest $request): View
    {
        return view('ads.admin.status.expired', [
            'ads' => $this->adminAdRepository->getAds(10, 'expired', $request->validated())
        ]);
    }

    /**
     * Display a rejected of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function rejected(FilterAdminAdsRequest $request): View
    {
        return view('ads.admin.status.rejected', [
            'ads' => $this->adminAdRepository->getAds(10, 'rejected', $request->validated())
        ]);
    }

    /**
     * Display a reported ad of the resource.
     * 
     * @param \App\Http\Requests\Ad\FilterAdminAdsRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function reported(FilterAdminAdsRequest $request): View
    {
        return view('ads.admin.status.reported', [
            'reportedAds' => $this->adminAdRepository->getReportedAds(10, $request->validated())
        ]);
    }

    /**
     * Display a reported ad of the resource.
     * 
     * @param string $adSlug
     * @return \Illuminate\Contracts\View\View
     */
    public function reportAd(string $adSlug): View
    {
        return view('ads.admin.report', [
            'reportAd' => $this->adminAdRepository->getReportedAd($adSlug)
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  string  $ad
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $adSlug): View
    {
        return view('ads.admin.show', [
            'ad' => $this->adminAdRepository->getAdBySlug($adSlug)
        ]);
    }

    /**
     * Edit the specified resource in storage.
     *
     * @param  string  $ad
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $adSlug): View
    {
        return view('ads.admin.edit', [
            'ad' => $this->adminAdRepository->getAdBySlug($adSlug)
        ]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  string  $ad
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Requests\Ad\UpdateAdAdminRequest
     */
    public function update(string $adSlug, UpdateAdAdminRequest $request): RedirectResponse
    {
        $this->adminAdRepository->updateAd($adSlug, $request->validated());

        return redirect()->route('admin.ads.show', $adSlug)->with('success', 'Ad updated successfully.');
    }

    /**
     * Delete the specified resource in storage.
     * 
     * @param  string  $ad
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $adSlug): RedirectResponse
    {
        $this->adminAdRepository->deleteAd($adSlug);
        return redirect()->route('admin.ads.index', $adSlug)->with('success', 'Ad deleted successfully.');
    }
}
