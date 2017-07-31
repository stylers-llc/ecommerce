<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Entities\ProductEntity;
use Stylers\Ecommerce\Models\Product;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $cartList = $request->all();
        echo '<pre>';
        var_dump($cartList);
    }
}