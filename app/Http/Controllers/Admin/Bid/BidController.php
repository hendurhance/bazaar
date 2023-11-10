<?php

namespace App\Http\Controllers\Admin\Bid;

use App\Contracts\Repositories\AdminBidRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bid\FilterAdminBidRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BidController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminBidRepositoryInterface $adminBidRepository)
    {
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \App\Http\Requests\Bid\FilterAdminBidRequest $query
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminBidRequest $query): View
    {
        return view('bids.admin.index', [
            'bids' => $this->adminBidRepository->getBids(10, $query->validated()),
        ]);
    }

    /**
     * Show a listing of the resource.
     * 
     * @param string $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        return view('bids.admin.show', [
            'bid' => $this->adminBidRepository->getBid($id),
        ]);
    }
}
