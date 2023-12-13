<?php

namespace App\Http\Controllers\User\Payout;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Contracts\Repositories\PayoutRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\FilterUserPaymentRequest;
use App\Http\Requests\Payout\RequestPayout;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PayoutController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(
        protected PayoutRepositoryInterface $payoutRepository,
        protected PaymentRepositoryInterface $paymentRepository,
        protected AuthenticateRepositoryInterface $authRepository
    ) {
    }

    /**
     * Get payee payments
     * 
     * @param \App\Http\Requests\Payment\FilterUserPaymentRequest $filter
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterUserPaymentRequest $filter): View
    {
        return view('payouts.user.index', [
            'payments' => $this->paymentRepository->getUserPayments($this->authRepository->user(), 'payee_id', 10, $filter->validated()),
        ]);
    }

    /**
     * Get payer payments
     * 
     * @param string $txnId
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $txnId): View
    {
        return view('payouts.user.show', [
            'payment' => $this->payoutRepository->getUserPayment($this->authRepository->user(), $txnId),
        ]);
    }

    /**
     * Request payout
     * 
     * @param string $txnId
     * @param \App\Http\Requests\Payout\RequestPayout $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function request(string $txnId, RequestPayout $request): RedirectResponse
    {
        $this->payoutRepository->request($this->authRepository->user(), $txnId, $request->validated());

        return redirect()->back()->with('success', 'Payout request has been sent, you will be notified when it is processed');
    }
}
