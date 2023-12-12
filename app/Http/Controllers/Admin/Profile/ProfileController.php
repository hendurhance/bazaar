<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateAdminPasswordRequest;
use App\Http\Requests\Profile\UpdateAdminProfileRequest as ProfileUpdateAdminProfileRequest;

class ProfileController extends Controller
{
    /**
     * Instantiate new controller instance
     */
    public function __construct(protected AuthenticateRepositoryInterface $authenticateRepository)
    {}

    /**
     * View admin profile data
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('profile.admin.index');
    }

    /**
     * Update admin profile data
     * 
     * @param \App\Http\Request\R
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateAdminProfileRequest $request)
    {
        $this->authenticateRepository->update($this->authenticateRepository->admin(), $request->validated());
        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Change password for admin profile
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function changePassword(UpdateAdminPasswordRequest $request)
    {
        $this->authenticateRepository->updatePassword($this->authenticateRepository->admin(), $request->validated());
        return back()->with('success', 'Password updated successfully.');
    }
}
