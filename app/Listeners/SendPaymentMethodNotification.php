<?php

namespace App\Listeners;

use App\Events\PaymentMethodCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPaymentMethodNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentMethodCreatedEvent $event): void
    {
        //
    }
}
