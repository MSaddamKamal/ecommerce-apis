<?php

namespace App\Modules\Analytics\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;
use App\Modules\Analytics\Repositories\AnalyticsRepository;

class AnalyticsRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // binding  repository interface to  repo concrete class, for decoupling
         $this->app->bind(AnalyticsRepositoryContract::class , AnalyticsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
