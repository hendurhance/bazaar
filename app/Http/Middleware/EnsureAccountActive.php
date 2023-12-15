<?php

namespace App\Http\Middleware;

use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class EnsureAccountActive
{
    /**
     * Instantiate a new middleware instance.
     */
    public function __construct(protected AuthenticateRepositoryInterface $authRepository)
    {}

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->authRepository->user() || $this->authRepository->admin()) {
            if($this->authRepository->user()) {
                // check if user is active
                if (!$this->authRepository->user()->is_active) {
                    $this->authRepository->logout($request, 'web');
                    return redirect()->route('user.login')->with('error', 'Your account has been deactivated, contact support for more information.');
                }
            }
            if($this->authRepository->admin()) {
                if (!$this->authRepository->admin()->is_active) {
                    $this->authRepository->logout($request, 'admin_web');
                    return redirect()->route('admin.login')->with('error', 'Your account has been deactivated, contact support for more information.');
                }
            }
        }

        return $next($request);
    }
}
