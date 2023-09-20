<?php

namespace App\Http\Controllers\User\Payment;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PaymentRepositoryInterface;
use App\Http\Controllers\Controller;

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
        return view('user.payment.index', [
            'payments' => $this->paymentRepository->getAd
            ($this->authRepository->getUser()->id)
        ]);
    }
}
