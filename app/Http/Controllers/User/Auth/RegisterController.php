<?php

namespace App\Http\Controllers\User\Auth;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * @param AuthenticateRepositoryInterface $repository
     */
    public function __construct(protected AuthenticateRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest')->except('resendVerificationEmail');
    }

    /**
     * Register a new user.
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->repository->register($request->validated());

        return redirect()->route('user.login')->with('success', 'Your account has been created successfully, verify your email to login.');
    }

    /**
     * Verify a user's email.
     * @param string $token
     * @return RedirectResponse
     */
    public function verify(string $token): RedirectResponse
    {
        $this->repository->verify($token);

        return redirect()->route('user.login')->with('success', 'Your email has been verified, you can now login.');
    }

    /**
     * Resend the email verification notification.
     * 
     * @return RedirectResponse
     */
    public function resendVerificationEmail(): RedirectResponse
    {
        $this->repository->sendEmailVerificationLink($this->repository->user());

        return back()->with('success', 'A new verification link has been sent to your email address.');
    }
}
