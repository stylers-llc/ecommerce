<?php

namespace Stylers\Ecommerce\Listeners;

use Illuminate\Support\Facades\Config;
use Stylers\Ecommerce\Events\PaymentSuccessEvent;
use Mail;

class SendSuccessMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  PaymentSuccessEvent  $event
     * @return void
     */
    public function handle(PaymentSuccessEvent $event)
    {
        Mail::send('successMail', ['basketInfo' => $event->basketInfo], function($message) use ($event) {
            $message->from(config('ecommerce.email_from'));
            $message->to($event->basket->user->email);
            $message->subject('Payment Success');
        });
    }
}
