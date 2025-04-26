<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use App\Services\CustomPasswordBroker;

class CustomPasswordResetServiceProvider extends ServiceProvider 
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('auth.password', function ($app) {
            return new PasswordBrokerManager($app);
        });

        $this->app->singleton('auth.password.broker', function ($app) {
            return new CustomPasswordBroker(
                $app['auth.password.tokens'],
                $app['auth.password.database']
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
