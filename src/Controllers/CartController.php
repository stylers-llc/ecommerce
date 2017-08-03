<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Models\Cart;


class CartController extends Controller
{
    public function index() {
        return Cart::get();
    }

    public function cartList() {
        $error = Session::get('error');
        Session::forget('error');
        $cartList = Cart::get();
        $cartListJson = json_encode($cartList);
        return View::make('cartList', ['cartList' => $cartList, 'cartListJson' => $cartListJson, 'error' => $error]);
    }

    public function add(Request $request, $id) {
        Cart::add($id);

        return [
            'success' => true,
            'itemNumber' => Cart::getProductCount(),
            'msg' => "Product added to cart"
        ];
    }
}