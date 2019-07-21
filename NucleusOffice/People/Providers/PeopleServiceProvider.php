<?php

namespace NucleusOffice\People\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use NucleusOffice\People\Entities\Owner;
use NucleusOffice\People\Entities\Renter;
use NucleusOffice\People\Entities\User;
use NucleusOffice\People\Repositories\RenterRepository;
use NucleusOffice\People\Repositories\UserRepository;
use NucleusOffice\People\Repositories\OwnerRepository;
use NucleusOffice\People\Contracts\User as UserContract;
use NucleusOffice\People\Contracts\Owner as OwnerContract;
use NucleusOffice\People\Contracts\Renter as RenterContract;
use Laravel\Passport\Passport;

class PeopleServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->make('router')->aliasMiddleware('auth', \NucleusOffice\People\Http\Middleware\AuthMiddleware::class);

        $this->app->make('router')->middleware(\Spatie\Cors\Cors::class);

        Relation::morphMap([
            'users' => User::class,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        Passport::ignoreMigrations();

        $this->app->bind(
            UserContract::class,
            UserRepository::class
        );
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('people.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'people'
        );
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
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
