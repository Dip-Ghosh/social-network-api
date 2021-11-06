<?php

namespace App\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\LoginRegistrationInterface',
            'App\Repository\LoginRegistrationRepository'
        );

        $this->app->bind(
            'App\Repository\PageInterface',
            'App\Repository\PageRepository'
        );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
