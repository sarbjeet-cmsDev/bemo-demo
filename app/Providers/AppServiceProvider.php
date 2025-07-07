<?php

namespace App\Providers;
use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('ticket-classifier', function () {
            return Limit::perMinute(60); // Limit to 60 jobs per minute
        });
    }
}
