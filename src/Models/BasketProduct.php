<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BasketProduct extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'basket_id',
        'product_id',
        'price',
        'qty'
    ];

    public function getTotal()
    {
        return $this->attributes['qty'] * $this->attributes['price'];
    }

    public function basket()
    {
        return $this->hasOne(Basket::class, 'id', 'basket_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id', 'product_id')->withTrashed();
    }
}