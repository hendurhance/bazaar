<?php

namespace App\Http\Controllers\Admin\Payout;

use App\Contracts\Repositories\AdminPayoutMethodRepositoryInterface;
use App\Http\Controllers\Controller;
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
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        return view('payout-methods.admin.index', [
            'payoutMethods' => $this->payoutRepository->getPayoutMethods(10, $request->all()),
        ]);
    }

    /**
     * Get payout method by id
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $id): \Illuminate\Contracts\View\View
    {
        return view('payout-methods.admin.show', [
            'payoutMethod' => $this->payoutRepository->getPayoutMethod($id),
        ]);
    }
}
