<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    public function baskets()
    {
        return $this->hasMany(Basket::class, 'user_id', 'id');
    }
}