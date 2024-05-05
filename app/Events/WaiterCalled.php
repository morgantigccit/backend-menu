<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WaiterCalled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tableNumber;
    public $restaurant_name;

    public function __construct($tableNumber,$restaurant_name)
    {
        $this->tableNumber = $tableNumber;
        $this->restaurant_name = $restaurant_name;

    }

    public function broadcastOn()
    {
        return new Channel('waiter-calls');
    }
    public function broadcastAs()
    {
        return 'WaiterCalled';
    }
}
