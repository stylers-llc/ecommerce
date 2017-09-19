<?php

namespace Stylers\Ecommerce\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Stylers\Ecommerce\Models\Basket;

class PaymentSuccessEvent extends Event
{
    use SerializesModels;

    public $basket;
    public $basketInfo;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Basket $basket)
    {
        $this->basket = $basket;
        $this->basketInfo = Basket::getBasketInfoById($basket->id);
    }
}
