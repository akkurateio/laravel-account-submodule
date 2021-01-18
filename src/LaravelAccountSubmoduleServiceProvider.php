<?php

namespace Akkurate\LaravelAccountSubmodule;

use Illuminate\Support\ServiceProvider;

class LaravelAccountSubmoduleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-account-submodule.php' => config_path('laravel-account-submodule.php'),
        ], 'account-submodule-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'account-submodule-migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/laravel-account-submodule.php',
            'laravel-account-submodule'
        );
    }
}
