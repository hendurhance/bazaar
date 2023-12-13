<?php

namespace App\Http\Controllers\Admin\Payout;

use App\Contracts\Repositories\AdminPayoutMethodRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payout\FilterAdminPayoutMethodRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PayoutMethodController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminPayoutMethodRepositoryInterface $payoutRepository)
    {
    }

    /**
     * Get all payout methods
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterAdminPayoutMethodRequest $request): View
    {
        return view('payout-methods.admin.index', [
            'payoutMethods' => $this->payoutRepository->getPayoutMethods(10, $request->validated()),
        ]);
    }

    /**
     * Get payout method by id
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): View
    {
        return view('payout-methods.admin.show', [
            'payoutMethod' => $this->payoutRepository->getPayoutMethod($id),
        ]);
    }
}
