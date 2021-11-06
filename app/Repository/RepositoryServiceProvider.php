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

        $this->app->bind(
            'App\Repository\FollowerInterface',
            'App\Repository\FollowerRepository'
        );

        $this->app->bind(
            'App\Repository\PostInterface',
            'App\Repository\PostRepository'
        );
        $this->app->bind(
            'App\Repository\FeedInterface',
            'App\Repository\FeedRepository'
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
