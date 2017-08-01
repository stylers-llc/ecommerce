<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Stylers\Ecommerce\Models\Basket;
use Stylers\Ecommerce\Models\Cart;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $cartList = $request->all();
        Cart::update($cartList);
        if(Cart::getProductCount() < 1){
            Redirect::route('ecommerce/products/list');
        }

        $basket = Basket::createBasket(Cart::get()['cart']);
        Cart::clear();
    }
}