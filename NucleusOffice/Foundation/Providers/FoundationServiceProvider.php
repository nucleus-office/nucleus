<?php

namespace NucleusOffice\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class FoundationServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('foundation.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'foundation'
        );
        $this->publishes([
            __DIR__.'/../Config/auth.php' => config_path('auth.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../Config/cors.php' => config_path('cors.php'),
        ], 'config');
        $this->publishes([
            __DIR__.'/../Config/json-api-paginate.php' => config_path('json-api-paginate.php'),
        ], 'config');

        // Overrides config files
        $this->app['config']->set('auth', require __DIR__.'/../Config/auth.php');
        $this->app['config']->set('json-api-paginate', require __DIR__.'/../Config/json-api-paginate.php');
        $this->app['config']->set('cors', require __DIR__.'/../Config/cors.php');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
