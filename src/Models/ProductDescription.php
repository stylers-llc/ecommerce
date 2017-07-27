<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\DescriptionTrait;

class ProductDescription extends Model
{
    use SoftDeletes,
        DescriptionTrait;

    protected $fillable = [
        'product_id', 'taxonomy_id', 'description_id'
    ];


}