<?php

namespace Tests\Feature\EventListener;

use App\Events\OrderSubmited;
use App\Notifications\OrderSubmitedVisitorNotification;
use App\Notifications\OrderSubmitedWarehouseNotification;
use App\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Markdown;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class OrderSubmittedListenerTest extends TestCase
{
    /** @test */
    public function will_dispatch_notification_on_event_dispatch()
    {
        $order = factory(Order::class)->create();
        Queue::fake();
        Notification::fake();

        OrderSubmited::dispatch($order);

        Notification::assertSentTo(new AnonymousNotifiable, OrderSubmitedWarehouseNotification::class);
        Notification::assertSentTo(new AnonymousNotifiable, OrderSubmitedVisitorNotification::class);
    }
}
