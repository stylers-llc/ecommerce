<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\ClassificationTrait;
use Stylers\Taxonomy\Models\Taxonomy;

class ProductClassification extends Model
{
    use SoftDeletes,
        ClassificationTrait;

    protected $fillable = [
        'product_id', 'taxonomy_id', 'value_taxonomy_id', 'priority', 'is_listable'
    ];

    public function product() {
        return $this->hasOne(Product::class);
    }

    public function classificationTaxonomy() {
        return $this->hasOne(Taxonomy::class, 'id', 'taxonomy_id');
    }

    public function valueTaxonomy() {
        return $this->hasOne(Taxonomy::class, 'id', 'value_taxonomy_id');
    }
}