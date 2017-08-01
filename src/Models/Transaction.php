<?php

namespace Stylers\Ecommerce\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_id',
        'basket_id',
        'pay_status_tx_id'
    ];

    public function basket()
    {
        return $this->hasOne(Basket::class, 'id', 'basket_id');
    }

    public function payStatus()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'pay_status_tx_id');
    }
}