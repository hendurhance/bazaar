<?php

namespace App\Providers;

use App\Contracts\Repositories\AdRepositoryInterface;
use App\Contracts\Repositories\AuthenticateRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\CountryRepositoryInterface;
use App\Repositories\Auth\AuthenticateRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Country\CountryRepository;
use App\Repositories\Repositories\AdRepository;
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

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CountryRepositoryInterface::class,
            CountryRepository::class
        );

        $this->app->bind(
            AdRepositoryInterface::class,
            AdRepository::class
        );
    }
}
