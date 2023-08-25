<?php

namespace App\Providers;

use App\Contracts\Repository\AuthenticateRepositoryInterface;
use App\Repositories\Auth\AuthenticateRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            AuthenticateRepositoryInterface::class,
            AuthenticateRepository::class
        );
    }
}
