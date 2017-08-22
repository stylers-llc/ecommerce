<?php

namespace Stylers\Ecommerce\Listeners;

use Stylers\Ecommerce\Events\PaymentSuccessEvent;

class UpdateProductNumberOfSales
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
        foreach ($event->basket->basketProducts as $basketProduct) {
            $product = $basketProduct->product;
            $product->number_of_sales = $product->number_of_sales + $basketProduct->qty;
            if(!is_null($product->stock)) {
                $product->stock = $product->stock - $basketProduct->qty;
            }
            $product->save();
        }
    }
}