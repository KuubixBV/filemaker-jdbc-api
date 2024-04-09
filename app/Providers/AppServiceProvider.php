<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\JdbcRepoInterface;
use App\Repositories\JdbcRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JdbcRepoInterface::class, JdbcRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
