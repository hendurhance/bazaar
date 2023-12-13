<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Contracts\Repositories\AdminPaymentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\FilterAdminPaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentAdminStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{

    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AdminPaymentRepositoryInterface $adminPaymentRepository)
    {}

    /**
     * Get all payments
     * 
     * @param FilterAdminPaymentRequest $query
     * @return \Illuminate\View\View
     */
    public function index(FilterAdminPaymentRequest $query): View
    {
        return view('payments.admin.index', [
            'payments' => $this->adminPaymentRepository->getAllPayments(10, 'all', $query->validated())
        ]);
    }

    /**
     * Get all pending payments
     * 
     * @param FilterAdminPaymentRequest $query
     * @return \Illuminate\View\View
     */
    public function pending(FilterAdminPaymentRequest $query): View
    {
        return view('payments.admin.status.pending', [
            'pendingPayments' => $this->adminPaymentRepository->getAllPayments(10, 'pending', $query->validated())
        ]);
    }

    /**
     * Get all failed payments
     * 
     * @param FilterAdminPaymentRequest $query
     * @return \Illuminate\View\View
     */
    public function failed(FilterAdminPaymentRequest $query): View
    {
        return view('payments.admin.status.failed', [
            'failedPayments' => $this->adminPaymentRepository->getAllPayments(10, 'failed', $query->validated())
        ]);
    }

     /**
     * Get all success payments
     * 
     * @param FilterAdminPaymentRequest $query
     * @return \Illuminate\View\View
     */
    public function success(FilterAdminPaymentRequest $query): View
    {
        return view('payments.admin.status.successful', [
            'successfulPayments' => $this->adminPaymentRepository->getAllPayments(10, 'success', $query->validated())
        ]);
    }

    /**
     * Get a payment
     * 
     * @param string $txnId
     * @return \Illuminate\View\View
     */
    public function show(string $txnId): View
    {
        return view('payments.admin.show', [
            'payment' => $this->adminPaymentRepository->getPayment($txnId)
        ]);
    }

    /**
     * Update a payment status
     * 
     * @param string $txnId
     * @param UpdatePaymentAdminStatus $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(string $txnId, UpdatePaymentAdminStatus $request): RedirectResponse
    {
        $this->adminPaymentRepository->updatePaymentStatus($txnId, $request->validated()['status']);

        return back()->with('success', 'Payment status updated.');
    }
}
