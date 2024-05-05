<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $restaurant_name;

    public function __construct(Order $order,$restaurant_name)
    {
        $this->order = $order;
        $this->restaurant_name = $restaurant_name;

    }

    public function broadcastOn()
    {
        // Specify the channel name you want to broadcast on
        return new Channel('orders');
    }
}
