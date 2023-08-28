<?php

namespace App\Http\Controllers\User\Auth;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    protected const GUARD = 'web';

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
     * Login a user.
     * 
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $this->repository->login($request->validated(), self::GUARD);

        return redirect()->route('user.dashboard');
    }

    /**
     * Logout a user.
     * 
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        $this->repository->logout(self::GUARD);

        return redirect()->route('user.login');
    }
}
