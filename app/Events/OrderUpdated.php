<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderUpdated implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $tableNumber;
    public $restaurant_name;

    public function __construct($tableNumber,$restaurant_name)
    {
        $this->tableNumber = $tableNumber;
        $this->restaurant_name = $restaurant_name;
    }


    public function broadcastOn()
    {
        return new Channel('orders');
    }

    public function broadcastAs()
    {
        return 'OrderUpdated';
    }
}
