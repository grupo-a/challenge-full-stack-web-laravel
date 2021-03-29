<?php

namespace App\Providers;

use App\Repositories\Contracts\{
    StudentRepositoryInterface
};
use App\Repositories\{
    StudentRepository
};
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
            StudentRepositoryInterface::class,
            StudentRepository::class
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
