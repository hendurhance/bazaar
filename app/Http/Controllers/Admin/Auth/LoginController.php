<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected const GUARD = 'admin_web';

    /** 
     * Instantiate a new controller instance.
     * @param AuthenticateRepositoryInterface $repository
     */
    public function __construct(protected AuthenticateRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest:admin_web')->except('logout');
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

        return redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Logout a user.
     * 
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->repository->logout($request, self::GUARD);

        return redirect()->route('admin.login');
    }
}
