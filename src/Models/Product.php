<?php

namespace Stylers\Ecommerce\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\Description;
use Stylers\Taxonomy\Models\ClassificableTrait;

class Product extends Model
{
    use SoftDeletes,
        ClassificableTrait;

    protected $fillable = [
        'name_description_id',
        'type_taxonomy_id',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
        'location_id'
    ];

    public function name() {
        return $this->hasOne(Description::class, 'id', 'name_description_id');
    }

    public function type() {
        return $this->hasOne(Taxonomy::class, 'id', 'type_taxonomy_id');
    }
}