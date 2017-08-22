<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\Description;
use Stylers\Taxonomy\Models\ClassificableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Product extends Model
{
    use SoftDeletes,
        ClassificableTrait;

    protected $fillable = [
        'name_description_id',
        'type_taxonomy_id',
        'is_active',
        'price',
        'number_of_sales',
        'is_singleton',
        'stock',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function name() {
        return $this->hasOne(Description::class, 'id', 'name_description_id');
    }

    public function type() {
        return $this->hasOne(Taxonomy::class, 'id', 'type_taxonomy_id');
    }

    public static function getTop(int $number = 5,string $type = null) {
        $typeTx = null;
        if($type) {
            try {
                $typeTx = Taxonomy::getTaxonomy($type, config('ecommerce.product_type'));
            } catch (ModelNotFoundException $ex) {}
        }

        if($typeTx) {
            return Product::where('type_taxonomy_id',$typeTx->id)->orderBy('number_of_sales','desc')->take($number)->get();
        }
        return Product::orderBy('number_of_sales DESC')->take($number)->get();
    }
}