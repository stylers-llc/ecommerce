<?php

namespace Stylers\Ecommerce\Models;

class Cart
{
    const APP_PRODUCT_ENTITY = "\App\Entities\ProductEntity";
    const DEFAULT_PRODUCT_ENTITY = "\Stylers\Ecommerce\Entities\ProductEntity";

    public static function get() : array
    {
        $cart = \Session::get('cart');
        $productIds = array_keys((array) $cart);

        $products = [];
        $has_shipping = false;
        $hasAppEntity = class_exists(self::APP_PRODUCT_ENTITY);
        for($i = 0; $i < count($productIds); $i++) {
            $productId = $productIds[$i];
            $product = Product::findOrFail($productId);
            if($product->type_taxonomy_id == \Config::get('ecommerce.product_types.equipment')) {
                $has_shipping = true;
            }

            if($hasAppEntity) {
                $entity = self::APP_PRODUCT_ENTITY;
            } else {
                $entity = self::DEFAULT_PRODUCT_ENTITY;
            }

            $products[$productId] = (new $entity($product))->getFrontendData();
        }

        return [
            'success' => true,
            'itemNumber' => self::getProductCount(),
            'cart' => \Session::get('cart'),
            'products' => $products,
            'tax' => \Config::get('ecommerce.tax'),
            'shipping_fee' => \Config::get('ecommerce.shipping_fee'),
            'has_shipping' => $has_shipping
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
        $product = Product::findOrFail($productId);
        $cart = \Session::get('cart');
        if(array_key_exists($productId, (array) $cart)) {
            if($product->is_singleton) {
                $cart[$productId] = 1;
            } else {
                $cart[$productId] = $cart[$productId] + 1;
            }
        } else {
            if(is_null($cart)) {
                $cart = [];
            }
            $cart[$productId] = 1;
        }
        \Session::put('cart', $cart);
    }

    public static function remove(int $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = \Session::get('cart');
        if(array_key_exists($productId, (array) $cart)) {
            unset($cart[$productId]);
        }
        \Session::put('cart', $cart);
    }

    public static function change(int $productId, int $number) {
        if($number < 1) {
            self::remove($productId);
        } else {
            $product = Product::findOrFail($productId);
            $cart = \Session::get('cart');
            if($product->is_singleton) {
                $cart[$productId] = 1;
            } else {
                $cart[$productId] = $number;
            }
            \Session::put('cart', $cart);
        }
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