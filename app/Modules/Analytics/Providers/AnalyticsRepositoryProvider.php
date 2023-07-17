<?php

namespace App\Modules\Analytics\Providers;

use App\Modules\Analytics\Events\ItemAdded;
use App\Modules\Analytics\Events\ItemPurchased;
use App\Modules\Analytics\Events\ItemViewed;
use App\Modules\Analytics\Events\UserRegistered;
use App\Modules\Analytics\Listeners\AddItemAddedAnalytics;
use App\Modules\Analytics\Listeners\AddItemPurchasedAnalytics;
use App\Modules\Analytics\Listeners\AddItemViewedAnalytics;
use App\Modules\Analytics\Listeners\AddUserRegisteredAnalytics;
use Illuminate\Support\ServiceProvider;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;
use App\Modules\Analytics\Repositories\AnalyticsRepository;
use Illuminate\Support\Facades\Event;

class AnalyticsRepositoryProvider extends ServiceProvider
{
    /**
     * @var \string[][]
     */
    protected $listen = [
        ItemViewed::class => [
            AddItemViewedAnalytics::class,
        ],
        ItemAdded::class => [
            AddItemAddedAnalytics::class,
        ],
        ItemPurchased::class => [
            AddItemPurchasedAnalytics::class,
        ],
        UserRegistered::class => [
            AddUserRegisteredAnalytics::class,
        ],
    ];

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
        foreach ($this->listen as $event => $listeners) {
            foreach (array_unique($listeners, SORT_REGULAR) as $listener) {
                Event::listen($event, $listener);
            }
        }
    }


}
