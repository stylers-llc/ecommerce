<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use Stylers\Taxonomy\Models\Taxonomy;

class Basket extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'basket_status_tx_id',
        'currency',
        'total', // sub_total_gross + shipping_fee
        'shipping_fee',
        'sub_total',  // sub_total net
        'sub_total_gross'
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
    }

    public static function refreshTotal(Basket $basket)
    {
        $total = 0;
        $sub_total = 0;
        $has_shipping = false;
        foreach ($basket->basketProducts as $basketProduct) {
            $sub_total += $basketProduct->qty * $basketProduct->price;
            if($basketProduct->product->type_taxonomy_id == \Config::get('ecommerce.product_types.equipment')) {
                $has_shipping = true;
            }
        }

        if($has_shipping) {
            $total += \Config::get('ecommerce.shipping_fee');
            $basket->shipping_fee = \Config::get('ecommerce.shipping_fee');
        }

        $sub_total_gross = $sub_total * \Config::get('ecommerce.tax');
        $basket->sub_total = $sub_total;
        $basket->sub_total_gross = $sub_total_gross;
        $basket->total = $total + $sub_total_gross;
        $basket->save();
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
            if($product->is_singleton && $productNumber > 1) {
                $productNumber = 1;
            }

            $basketProduct = new BasketProduct();
            $basketProduct->product_id = $product->id;
            $basketProduct->price = $product->price;
            $basketProduct->qty = $productNumber;
            $basketProduct->save();
            $basket->addProduct($basketProduct);
        }

        self::refreshTotal($basket);

        return $basket;
    }


    public static function getPaidBaskets() {
        return self::getBaseBasketEloquent((int) config('ecommerce.basket_statuses.paid'));
    }

    public static function getBaseBasketEloquent(int $statusId = null) {
        $basket = Basket::with([
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
        ]);

        if($statusId) {
            $basket->where('basket_status_tx_id', $statusId);
        }

        $basket->orderBy('updated_at', 'desc');

        return $basket;
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

    public static function getBasketsInfoByUserId(int $userId) {
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
        ])->where('user_id',$userId)->get();
    }

    public static function changeBasketStatus(int $basketId, int $statusId) {
        $tx = Taxonomy::getTaxonomyById($statusId, config("ecommerce.basket_status"));
        $basket = self::findOrFail($basketId);
        $basket->basket_status_tx_id = $tx->id;
        return $basket->save();
    }
}