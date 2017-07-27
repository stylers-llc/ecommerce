<?php

namespace Stylers\Ecommerce\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\MetaTrait;
use Stylers\Taxonomy\Models\Taxonomy;

class ProductMeta
{
    use SoftDeletes,
        MetaTrait;

    protected $fillable = [
        'product_id',
        'taxonomy_id',
        'value',
        'priority',
        'is_listable'
    ];

    public function product() {
        return $this->hasOne(Product::class);
    }

    public function classificationTaxonomy() {
        return $this->hasOne(Taxonomy::class, 'id', 'taxonomy_id');
    }
}