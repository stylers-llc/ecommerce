<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    protected $table = 'user_addresses';

    protected $fillable = [
        'name',
        'phone',
        'user_id',
        'company_name',
        'country',
        'postal_code',
        'state',
        'city',
        'address_line',
        'address_line_2'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}