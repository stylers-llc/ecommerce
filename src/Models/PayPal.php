<?php

namespace Stylers\Ecommerce\Models;

use PayPal\Rest\ApiContext;

class PayPal
{
    private $_basket;
    private $_apiContext;

    public function __construct(Basket $basket)
    {
        $this->_apiContext = new ApiContext(new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret')));
        $this->_apiContext->setConfig(config('paypal.settings'));
        $this->_basket = $basket;
    }

    public function
}