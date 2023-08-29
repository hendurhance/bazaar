<?php

namespace App\Providers;

use App\Console\Commands\MakeInterfaceCommand;
use App\Console\Commands\MakeRepositoryCommand;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the repository command.
        $this->app->singleton('command.make.repository', function ($app) {
            return new MakeRepositoryCommand($app['files']);
        });
        
        // Register the interface command.
        $this->app->singleton('command.make.interface', function ($app) {
            return new MakeInterfaceCommand($app['files']);
        });

        $this->commands([
            'command.make.repository',
            'command.make.interface',
        ]);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
