<?php

namespace App\Providers;

use App\Console\Commands\LogPruneCommand;
use App\Console\Commands\MakeInterfaceCommand;
use App\Console\Commands\MakeRepositoryCommand;
use App\Models\Ad;
use App\Models\Media;
use App\Models\PayoutMethod;
use App\Models\User;
use App\Observers\AdObserver;
use App\Observers\MediaObserver;
use App\Observers\PayoutMethodObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Schema default string length.
        Schema::defaultStringLength(191);

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

        // Enable the query log.
        if (config('app.debug')) {
            DB::listen(function ($query) {
                Log::channel('query')->info($query->sql, $query->bindings, $query->time);
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->environment('local')) {
            User::observe(UserObserver::class);
            Ad::observe(AdObserver::class);
            Media::observe(MediaObserver::class);
            PayoutMethod::observe(PayoutMethodObserver::class);
        }
    }
}
