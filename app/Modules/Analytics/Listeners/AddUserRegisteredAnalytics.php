<?php

namespace App\Modules\Analytics\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Modules\Analytics\Events\UserRegistered;
use App\Modules\Analytics\Contracts\AnalyticsRepositoryContract;

class AddUserRegisteredAnalytics
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
     * @param UserRegistered $event
     */
    public function handle(UserRegistered $event): void
    {
        $this->analyticsRepositoryContract->create($event->analyticsStoreDTO);
    }
}
