<?php

namespace Stylers\Ecommerce\Manipulators;


use Illuminate\Support\Facades\Config;
use Stylers\Ecommerce\Models\Product;
use Stylers\Ecommerce\Models\ProductClassification;
use Stylers\Ecommerce\Models\ProductDescription;
use Stylers\Taxonomy\Manipulators\DescriptionSetter;
use Stylers\Taxonomy\Models\Description;
use Stylers\Taxonomy\Models\Taxonomy;

class ProductSetter extends Setter
{
    const CONNECTION_COLUMN = 'product_id';

    private $attributes = [
        "is_active" => null,
        "type_taxonomy_id" => null
    ];

    private $product;

    public static $rules = [
        'required' => [
            'product_type',
            'name'
        ],
        'rules' => [
            'product_type' => [
                'taxonomy' => [
                    'alias' => 'type_taxonomy_id',
                    'parent' => null,
                    'return' => 'id'
                ]
            ],
            'price' => [
                'positive_number' => true
            ]
        ]
    ];

    public function __construct(array $attributes)
    {
        self::$rules['rules']['product_type']['taxonomy']['parent'] = Config::get('ecommerce.product_type');
        $this->attributes = self::validateRules(self::$rules, $attributes);
    }

    public function set()
    {
        if(!empty($this->attributes['id'])) {
            $this->product = Product::findOrFail($this->attributes['id']);
            (new DescriptionSetter($this->attributes['name'], $this->product->name_description_id))->set();
        } else {
            $nameDescription = (new DescriptionSetter($this->attributes['name']))->set();
            $this->product = new Product();
            $this->product->name_description_id = $nameDescription->id;
        }

        $this->product->is_active = (bool) $this->attributes['is_active'];
        $this->product->type_taxonomy_id = $this->attributes['type_taxonomy_id'];
        $this->product->price = (!empty($this->attributes['price'])) ? $this->attributes['price'] : null;
        $this->product->is_singleton = (!empty($this->attributes['is_singleton'])) ? (bool) $this->attributes['is_singleton'] : false;

        if(!empty($this->attributes['slug']) && strlen(trim($this->attributes['slug'])) > 0) {
            $this->product->slug = $this->attributes['slug'];
        } else {
            $this->product->slug = str_slug(Description::find($this->product->name_description_id)->description);
        }

        if(empty($this->attributes['stock'])) {
            $this->product->stock = null;
        } else if (!empty($this->attributes['stock']) && filter_var($this->attributes['stock'], FILTER_VALIDATE_INT)){
            $this->product->stock = $this->attributes['stock'];
        }

        $this->product->saveOrFail();

        if(!empty($this->attributes['category'])) {
            $tx = Taxonomy::getOrCreateTaxonomy($this->attributes['category'], \Config::get('ecommerce.category'));
            ProductClassification::where('taxonomy_id', \Config::get('ecommerce.category'))->where('product_id',$this->product->id)->delete();
            $pc = new ProductClassification();
            $classification = $pc->insertOrUpdateClassification(
                'product_id',
                $this->product->id,
                \Config::get('ecommerce.category'),
                $this->attributes['category']
            );
        }

        if(!empty($this->attributes['descriptions']['short_description'])) {
            (new ProductDescription())->setDescription(
                self::CONNECTION_COLUMN,
                $this->product->id,
                Config::get('ecommerce.product_description_types.short_description'),
                $this->attributes['descriptions']['short_description']
            );
        }

        if(!empty($this->attributes['descriptions']['long_description'])) {
            (new ProductDescription())->setDescription(
                self::CONNECTION_COLUMN,
                $this->product->id,
                Config::get('ecommerce.product_description_types.long_description'),
                $this->attributes['descriptions']['long_description']
            );
        }

        return $this->product;
    }


}