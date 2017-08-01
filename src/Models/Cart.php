<?php

namespace Stylers\Ecommerce\Models;

use Stylers\Ecommerce\Entities\ProductEntity;

class Cart
{
    public static function get() : array
    {
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
            'itemNumber' => self::getProductCount(),
            'cart' => \Session::get('cart'),
            'products' => $products
        ];
    }

    public static function getProductCount() : int {
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

    public static function add(int $productId)
    {
        $cart = \Session::get('cart');
        if(array_key_exists($productId, (array) $cart)) {
            $cart[$productId] = $cart[$productId] + 1;
        } else {
            Product::findOrFail($productId);
            if(is_null($cart)) {
                $cart = [];
            }
            $cart[$productId] = 1;
        }
        \Session::put('cart', $cart);
    }

    public static function update(array $cartData)
    {
        $cart = [];
        $productIds = array_keys($cartData);
        foreach ($productIds as $productId) {
            Product::findOrFail($productId);
            $value = $cartData[$productId];
            if(!filter_var($value, FILTER_VALIDATE_INT)) {
                throw new \Exception("Invalid cart value");
            }
            if($value > 0) {
                $cart[$productId] = $value;
            }
        }
        \Session::put('cart', $cart);
    }

    public static function clear()
    {
        \Session::forget('cart');
    }
}