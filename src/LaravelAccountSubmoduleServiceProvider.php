<?php

namespace Akkurate\LaravelAccountSubmodule;

use Akkurate\LaravelAccountSubmodule\Console\InstallProcess;
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
        $this->configurePublishing();
        $this->configureCommands();
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

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-account-submodule.php' => config_path('laravel-account-submodule.php'),
        ], 'account-submodule-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'account-submodule-migrations');
    }

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallProcess::class,
        ]);
    }
}
