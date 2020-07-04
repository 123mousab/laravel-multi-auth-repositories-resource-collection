<?php

namespace App\Providers;

use App\Repositories\CusotmerRepositoryInterface;
use App\Repositories\CusotmerRepository;
use Illuminate\Support\ServiceProvider;


class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CusotmerRepositoryInterface::class, CusotmerRepository::class);
    }
}
