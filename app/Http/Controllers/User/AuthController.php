<?php

namespace App\Http\Controllers\User;

use App\Contracts\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /**
     * Instantiate a new controller instance.
     */
    public function __construct(protected AuthenticateRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Register a new user.
     * 
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->repository->register($request->validated());

        return redirect()->route('user.login')->with('success', 'Your account has been created successfully, verify your email to login.');
    }
}
