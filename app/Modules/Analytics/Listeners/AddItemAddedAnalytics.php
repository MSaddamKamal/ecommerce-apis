<?php

namespace App\Modules\Analytics\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Modules\Analytics\Events\ItemAdded;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;

class AddItemAddedAnalytics
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
     * @param ItemAdded $event
     */
    public function handle(ItemAdded $event): void
    {
        $this->analyticsRepositoryContract->create($event->analyticsStoreDTO);
    }
}
