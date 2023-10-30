<?php

namespace App\Http\Controllers\Admin\Ad;

use App\Contracts\Repositories\AdminAdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\FilterAdminAdsRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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

}
