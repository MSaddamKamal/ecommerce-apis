<?php

namespace App\Modules\Analytics\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Modules\Analytics\DTO\AnalyticsStoreDTO;

class ItemViewed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     *
     * @var AnalyticsStoreDTO $analyticsStoreDTO
     */
    public AnalyticsStoreDTO $analyticsStoreDTO;

    /**
     * Create a new event instance.
     *
     * @param AnalyticsStoreDTO $analyticsStoreDTO
     */
    public function __construct(AnalyticsStoreDTO $analyticsStoreDTO)
    {
        $this->analyticsStoreDTO = $analyticsStoreDTO;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
