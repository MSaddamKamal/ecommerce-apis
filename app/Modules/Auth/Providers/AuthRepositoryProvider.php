<?php

namespace App\Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Auth\Contracts\UserRepositoryContract;
use App\Modules\Auth\Repositories\UserRepository;

class AuthRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // binding user repository interface to user repo concrete class, for decoupling
         $this->app->bind(UserRepositoryContract::class , UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
