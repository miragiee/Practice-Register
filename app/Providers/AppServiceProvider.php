<?php

namespace App\Providers;

use Illuminate\Contracts\Console\Kernel as ConsoleKernelContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ConsoleKernelContract::class, \App\Console\Kernel::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
