<?php

namespace App\Providers;

use App\Http\Interfaces\SystemAnswerInterface;
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
            'App\Http\Interfaces\PostInterface',
            'App\Http\Repositories\PostRepository'
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
