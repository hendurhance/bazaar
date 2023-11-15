<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Contracts\Repositories\AdminPaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminPaymentRepositoryInterface $adminPaymentRepository)
    {
    }

    /**
     * Get all payments
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        return view('payments.admin.index', [
            'payments' => $this->adminPaymentRepository->getAllPayments(10, 'all', $request->all())
        ]);
    }

    /**
     * Get all pending payments
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function pending(Request $request): \Illuminate\View\View
    {
        return view('payments.admin.status.pending', [
            'payments' => $this->adminPaymentRepository->getAllPayments(10, 'pending', $request->all())
        ]);
    }

    /**
     * Get all failed payments
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function failed(Request $request): \Illuminate\View\View
    {
        return view('payments.admin.status.failed', [
            'payments' => $this->adminPaymentRepository->getAllPayments(10, 'failed', $request->all())
        ]);
    }

     /**
     * Get all success payments
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function success(Request $request): \Illuminate\View\View
    {
        return view('payments.admin.status.successful', [
            'payments' => $this->adminPaymentRepository->getAllPayments(10, 'success', $request->all())
        ]);
    }
}
