<?php

namespace App\Providers;

use App\Modules\Auth\Contracts\AuthenticationServiceContract;
use App\Modules\Auth\Services\AuthenticationService;
use Illuminate\Support\ServiceProvider;
use App\Modules\Auth\Providers\AuthServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            AuthenticationServiceContract::class,
            AuthenticationService::class,
        );

        $this->app->register(
            AuthServiceProvider::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
