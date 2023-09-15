<?php

namespace App\Http\Controllers\User\Profile;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AuthenticateRepositoryInterface $authRepository)
    {}

    /**
     * Show user profile.
     * 
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
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
    public function update(UpdateProfileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->authRepository->update($this->authRepository->user(), $request->validated());
        return redirect()->route('user.profile')->with('success', 'Your profile has been updated successfully.');
    }
}
