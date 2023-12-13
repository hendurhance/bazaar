<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PasswordController extends Controller
{
    /** 
     * Instantiate a new controller instance.
     * @param AuthenticateRepositoryInterface $repository
     */
    public function __construct(protected AuthenticateRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest');
    }

    /**
     * Forgot password.
     * 
     * @param ForgotPasswordRequest $request
     * @return RedirectResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): RedirectResponse
    {
        $this->repository->sendPasswordResetLink($request->email, \App\Models\Admin::class);

        return redirect()->route('admin.login')->with('success', 'A password reset link has been sent to your email.');
    }

    /**
     * Show reset password form.
     * 
     * @param string $token
     * @return View
     */
    public function resetPasswordForm(string $token): View
    {
        return view('auth.admin.password.reset', ['token' => $token]);
    }

    /**
     * Reset password.
     * 
     * @param string $token
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function resetPassword(ResetPasswordRequest $request): RedirectResponse
    {
        $this->repository->resetPassword($request->validated(), \App\Models\Admin::class);

        return redirect()->route('admin.login')->with('success', 'Your password has been reset.');
    }
}
