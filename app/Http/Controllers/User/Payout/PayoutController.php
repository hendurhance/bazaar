<?php

namespace App\Http\Controllers\User\Payout;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Contracts\Repositories\PayoutRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\FilterUserPaymentRequest;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected PayoutRepositoryInterface $payoutRepository, protected PaymentRepositoryInterface $paymentRepository, protected AuthenticateRepositoryInterface $authRepository)
    {}

    /**
     * Get payee payments
     * 
     * @param \App\Http\Requests\Payment\FilterUserPaymentRequest $filter
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterUserPaymentRequest $filter): \Illuminate\Contracts\View\View
    {
        return view('payouts.user.index', [
            'payments' => $this->paymentRepository->getUserPayments($this->authRepository->user(), 'payee_id', 10, $filter->validated()),
        ]);
    }
}
