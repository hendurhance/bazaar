<?php

namespace App\Http\Controllers\Admin\Payout;

use App\Contracts\Repositories\AdminPayoutRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payout\FilterAdminPayoutRequest;
use Illuminate\Contracts\View\View;

class PayoutController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminPayoutRepositoryInterface $adminPayoutRepository)
    {}

    /**
     * Get all payouts
     * 
     * @param FilterAdminPayoutRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminPayoutRequest $query): View
    {
        return view('payouts.admin.index', [
            'payouts' => $this->adminPayoutRepository->getAllPayouts(10, 'all', $query->validated())
        ]);
    }

    /**
     * Get all pending payouts
     * 
     * @param FilterAdminPayoutRequest $query
     * @return \Illuminate\View\View
     */
    public function pending(FilterAdminPayoutRequest $query): View
    {
        return view('payouts.admin.status.pending', [
            'pendingPayouts' => $this->adminPayoutRepository->getAllPayouts(10, 'pending', $query->validated())
        ]);
    }

    /**
     * Get all failed payouts
     * 
     * @param FilterAdminPayoutRequest $query
     * @return \Illuminate\View\View
     */
    public function failed(FilterAdminPayoutRequest $query): View
    {
        return view('payouts.admin.status.failed', [
            'failedPayouts' => $this->adminPayoutRepository->getAllPayouts(10, 'failed', $query->validated())
        ]);
    }

     /**
     * Get all success payouts
     * 
     * @param FilterAdminPayoutRequest $query
     * @return \Illuminate\View\View
     */
    public function success(FilterAdminPayoutRequest $query): View
    {
        return view('payouts.admin.status.successful', [
            'successfulPayouts' => $this->adminPayoutRepository->getAllPayouts(10, 'success', $query->validated())
        ]);
    }

    /**
     * Get payout by pyt_token
     * 
     * @param string $pyt_token
     * @return \Illuminate\View\View
     */
    public function show(string $id): View
    {
        return view('payouts.admin.show', [
            'payout' => $this->adminPayoutRepository->getPayout($id)
        ]);
    }
}
