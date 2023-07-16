<?php

namespace App\Modules\Analytics\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Modules\Analytics\Events\ItemViewed;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;

class AddItemViewedAnalytics
{

    /**
     * @var AnalyticsRepositoryContract
     */
    protected AnalyticsRepositoryContract $analyticsRepositoryContract;

    /**
     * Create the event listener.
     *
     * @param AnalyticsRepositoryContract $analyticsRepositoryContract
     */
    public function __construct(AnalyticsRepositoryContract $analyticsRepositoryContract)
    {
        $this->analyticsRepositoryContract = $analyticsRepositoryContract;
    }


    /**
     * Handle the event.
     * @param ItemViewed $event
     */
    public function handle(ItemViewed $event): void
    {
        $this->analyticsRepositoryContract->create($event->analyticsStoreDTO);
    }
}
