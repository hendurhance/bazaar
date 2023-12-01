<?php

namespace App\Http\Controllers\User\Profile;

use App\Contracts\Repositories\AnalyticRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AuthenticateRepositoryInterface $authRepository, protected AnalyticRepositoryInterface $analyticRepository)
    {}

    /**
     * Show dashboard page.
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard(): View
    {
        return view('dashboard.user.index', [
            'metrics' => $this->analyticRepository->getUserDashboardMetrics($this->authRepository->user()),
        ]);
    }

    /**
     * Show user profile.
     * 
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        return view('profile.user.index', [
            'user' => $this->authRepository->user(),
        ]);
    }

    /**
     * Update user profile.
     * 
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request): RedirectResponse
    {
        $this->authRepository->update($this->authRepository->user(), $request->validated());
        return redirect()->route('user.profile')->with('success', 'Your profile has been updated successfully.');
    }
}
