<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;

class Basket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'basket_status_tx_id',
        'currency',
        'total'
    ];

    public function status()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'basket_status_tx_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function basketProducts()
    {
        return $this->hasMany(BasketProduct::class, 'basket_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'basket_id', 'id');
    }

    public function addProduct(BasketProduct $product)
    {
        $product->basket_id = $this->id;
        $product->save();
        $this->total += $product->qty * $product->price;
        $this->save();
    }

    public function refreshTotal()
    {
        $total = 0;
        foreach ($this->basketProducts as $product) {
            $total += $product->qty * $product->price;
        }

        $this->total = $total;
        $this->save();
    }

    public static function createBasket(array $cart, int $userId = null) : Basket {
        $basket = new Basket();
        $basket->basket_status_tx_id = config('ecommerce.basket_statuses.created');
        $basket->currency = config('ecommerce.default_currency');
        if($userId) {
            $basket->user_id = $userId;
        }
        $basket->save();

        foreach($cart as $productId => $productNumber) {
            $product = Product::findOrFail($productId);
            $basketProduct = new BasketProduct();
            $basketProduct->product_id = $product->id;
            $basketProduct->price = $product->price;
            $basketProduct->qty = $productNumber;
            $basketProduct->save();
            $basket->addProduct($basketProduct);
        }

        return $basket;
    }

    public static function getBaseBasketEloquent() {
        return Basket::with([
            'user' => function($query) {
                $query->select([
                    'id', 'name', 'email', 'company', 'postal', 'country',
                    'state', 'city', 'address1', 'address2'
                ]);
            },
            'status' => function($query) {
                $query->select(['id', 'name']);
            }
        ])->orderBy('updated_at', 'desc');
    }

    public static function getBasketInfoById(int $id) {
        return Basket::with([
            'user' => function($query) {
                $query->select([
                    'id', 'name', 'email', 'company', 'postal', 'country',
                    'state', 'city', 'address1', 'address2'
                ]);
            },
            'status' => function($query) {
                $query->select(['id', 'name']);
            },
            'basketProducts.product' => function($query) {
                $query->select(['id', 'price', 'name_description_id', 'type_taxonomy_id']);
            },
            'basketProducts.product.name' => function($query) {
                $query->select(['id', 'description']);
            },
            'basketProducts.product.type' => function($query) {
                $query->select(['id', 'name']);
            }
        ])->where('id',$id)->firstOrFail();
    }
}