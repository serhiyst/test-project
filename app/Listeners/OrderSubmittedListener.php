<?php

namespace App\Listeners;

use App\Events\OrderSubmited;
use App\Notifications\OrderSubmitedVisitorNotification;
use App\Notifications\OrderSubmitedWarehouseNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class OrderSubmittedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderSubmited $event)
    {
        Notification::route('mail', 'warehouse@example.org')
            ->notify(new OrderSubmitedWarehouseNotification($event->order));
        Notification::route('mail', $event->order->email)
            ->notify(new OrderSubmitedVisitorNotification($event->order));
    }
}
