<?php

namespace App\Http\Controllers\User\Payout;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\PayoutMethodRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payout\CreatePayoutMethodRequest;
use App\Services\Payout\BankCodeService;

class PayoutMethodController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(
        protected PayoutMethodRepositoryInterface $payoutMethodRepository,
        protected AuthenticateRepositoryInterface $authRepository,
        protected BankCodeService $bankCodeService
    ) {
    }

    /**
     * Get user payout methods
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('payout-methods.user.index', [
            'payoutMethods' => $this->payoutMethodRepository->getUserPayoutMethods($this->authRepository->user(), 10),
        ]);
    }

    /**
     * Create user payout method
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        return view(
            'payout-methods.user.create',
            [
                'banks' => $this->bankCodeService->listBankCodes(['name', 'code', 'country']),
            ]
        );
    }

    /**
     * Store user payout method
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreatePayoutMethodRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->payoutMethodRepository->createUserPayoutMethod($this->authRepository->user(), $request->validated());

        return redirect()->route('user.payout-methods.index')->with('success', 'Payout method created successfully');
    }

    /**
     * Edit user payout method
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(string $id): \Illuminate\Contracts\View\View
    {
        return view('payout-methods.user.edit', [
            'payoutMethod' => $this->payoutMethodRepository->getUserPayoutMethod($this->authRepository->user(), $id),
            'banks' => $this->bankCodeService->listBankCodes(['name', 'code', 'country']),
        ]);
    }

    /**
     * Update user payout method
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CreatePayoutMethodRequest $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $this->payoutMethodRepository->updateUserPayoutMethod($this->authRepository->user(), $id, $request->validated());

        return redirect()->route('user.payout-methods.index')->with('success', 'Payout method updated successfully');
    }

    /**
     * Delete user payout method
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $this->payoutMethodRepository->deleteUserPayoutMethod($this->authRepository->user(), $id);

        return redirect()->route('user.payout-methods.index')->with('success', 'Payout method deleted successfully');
    }
}
