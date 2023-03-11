<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PendingOrder extends Notification
{
    use Queueable;
    public $orders;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct($order)
    {
        $this->orders = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'order_id' =>  $this->orders['id'],
            'email' =>  $this->orders['email'],
            'status' =>  $this->orders['order_status'],
            'name' => User::where('email', $this->orders['email'])->pluck('name')->first(),
            'message' => 'You have orders pending of ' . $this->orders['email'],
        ];
    }
}
