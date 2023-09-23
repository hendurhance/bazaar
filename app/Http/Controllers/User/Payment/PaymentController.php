<?php

namespace App\Http\Controllers\User\Payment;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\CreatePayRequest;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('payments.user.index', [
            'payments' => $this->paymentRepository->getUserPayments($this->authRepository->user(), 10)
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
     */
    public function confirm(string $txnId)
    {
        $bidID = $this->paymentRepository->confirm($txnId);
        return redirect()->route('user.listing-bids.show', $bidID)->with('success', 'Payment successful');
    }
}
