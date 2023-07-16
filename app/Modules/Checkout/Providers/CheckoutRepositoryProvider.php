<?php

namespace App\Modules\Checkout\Providers;

use App\Modules\Checkout\Contracts\CartRepositoryContract;
use App\Modules\Checkout\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;
use App\Modules\Checkout\Contracts\CartItemRepositoryContract;
use App\Modules\Checkout\Repositories\CartItemRepository;

class CheckoutRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // binding  repository interface to  repo concrete class, for decoupling
         $this->app->bind(CartItemRepositoryContract::class , CartItemRepository::class);

         $this->app->bind(CartRepositoryContract::class , CartRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
