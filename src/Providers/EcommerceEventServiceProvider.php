<?php

namespace Stylers\Ecommerce\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class EcommerceEventServiceProvider extends EventServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
        $events->listen(\Stylers\Ecommerce\Events\PaymentSuccessEvent::class, \Stylers\Ecommerce\Listeners\UpdateProductNumberOfSales::class);
        $events->listen(\Stylers\Ecommerce\Events\PaymentSuccessEvent::class, \Stylers\Ecommerce\Listeners\SendSuccessMessage::class);
        $events->listen(\Stylers\Ecommerce\Events\PaymentSuccessEvent::class, \Stylers\Ecommerce\Listeners\SendNewOrderMessage::class);
    }
}