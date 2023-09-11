<?php

namespace App\Http\Controllers\User\Profile;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Http\Controllers\Controller;
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
}
