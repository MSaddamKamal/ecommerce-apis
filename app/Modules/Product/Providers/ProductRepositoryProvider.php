<?php

namespace App\Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Product\Contracts\ProductRepositoryContract;
use App\Modules\Product\Repositories\ProductRepository;

class ProductRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
         // binding product repository interface to product repo concrete class, for decoupling
         $this->app->bind(ProductRepositoryContract::class , ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
