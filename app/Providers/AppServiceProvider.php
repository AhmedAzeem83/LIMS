<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any application services here
        // Example: Bind interfaces to implementations
        // $this->app->bind(SomeInterface::class, SomeImplementation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Place any bootstrapping logic here
        // Example: Set default string length for migrations
        // Schema::defaultStringLength(191);
    }
}
