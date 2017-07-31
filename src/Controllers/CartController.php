<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Entities\ProductEntity;
use Stylers\Ecommerce\Models\Product;


class CartController extends Controller
{
    public function index() {
        $cart = \Session::get('cart');
        $productIds = array_keys((array) $cart);

        $products = [];
        for($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $product = Product::findOrFail($productId);
            $products[$productId] = (new ProductEntity($product))->getFrontendData();
        }

        return [
            'success' => true,
            'itemNumber' => self::getCartProductCount(),
            'cart' => \Session::get('cart'),
            'products' => $products
        ];
    }

    public function cartList() {
        $cartList = $this->index();
        $cartListJson = json_encode($cartList);
        return View::make('cartList', ['cartList' => $cartList, 'cartListJson' => $cartListJson]);
    }

    public function add(Request $request, $id) {
        $cart = \Session::get('cart');
        if(array_key_exists($id, (array) $cart)) {
            $cart[$id] = $cart[$id] + 1;
        } else {
            Product::findOrFail($id);
            if(is_null($cart)) {
                $cart = [];
            }
            $cart[$id] = 1;
        }
        \Session::put('cart', $cart);

        return [
            'success' => true,
            'itemNumber' => self::getCartProductCount(),
            'msg' => "Product added to cart"
        ];
    }

    protected static function getCartProductCount() {
        $count = 0;
        $cart = \Session::get('cart');
        if(is_null($cart) || empty($cart)) {
            return $count;
        }

        foreach($cart as $productId => $productNumber) {
            $count += $productNumber;
        }

        return $count;
    }
}