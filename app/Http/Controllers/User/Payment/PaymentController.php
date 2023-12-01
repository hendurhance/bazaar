<?php

namespace App\Http\Controllers\User\Payment;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePayRequest;
use App\Http\Requests\Payment\FilterUserPaymentRequest;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PaymentController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected PaymentRepositoryInterface $paymentRepository, protected AuthenticateRepositoryInterface $authRepository)
    {}

    /**
     * Get purchase history
     * 
     * @param \App\Http\Requests\Payment\FilterUserPaymentRequest $filter
     * @return \Illuminate\Contracts\View\View
     */
    public function index(FilterUserPaymentRequest $filter): View
    {
        return view('payments.user.index', [
            'payments' => $this->paymentRepository->getUserPayments($this->authRepository->user(), 'payer_id', 10, $filter->validated()),
        ]);
    }

    /**
     * Show payment details
     * 
     * @param string $txnId
     * @return \Illuminate\Contracts\View\View
     */
    public function show(string $txnId): View
    {
        return view('payments.user.show', [
            'payment' => $this->paymentRepository->getUserPayment($this->authRepository->user(), $txnId),
        ]);
    }
    /**
     * Get sales history
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function sales(): View
    {
        return view('payments.user.sales', [
            'payments' => $this->paymentRepository->getUserPayments($this->authRepository->user(), 'payee_id', 10),
        ]);
    }

    /**
     * Pay for an ad
     * 
     * @param CreatePayRequest $request
     * @param string $ad
     * @return RedirectResponse
     */
    public function pay(CreatePayRequest $request, string $bid): RedirectResponse
    {
        $url = $this->paymentRepository->pay($bid, $this->authRepository->user(), $request->payment_method);
        return redirect($url);
    }

    /**
     * Confirm payment
     * 
     * @param string $txnId
     * @return RedirectResponse
     */
    public function confirm(string $txnId): RedirectResponse
    {
        $transactionID = request()->query('transaction_id');
        $bidID = $this->paymentRepository->confirm($txnId, $transactionID);
        return redirect()->route('user.listing-bids.show', $bidID)->with('success', 'Payment successful');
    }
}
