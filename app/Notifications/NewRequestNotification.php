<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'New Request',
            'body' => 'You have a new waiter request.',
            // You can add more data here as needed
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            // This array can be customized based on what you want to store in the database
            // 'request_id' => $this->request->id, // Assuming the request has an ID
            'message' => 'A new waiter has been added.'
        ];
    }
}
