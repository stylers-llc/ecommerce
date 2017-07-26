<?php

namespace Stylers\Ecommerce\Entities;


use Stylers\Ecommerce\Models\Product;
use Stylers\Taxonomy\Entities\DescriptionEntity;
use Stylers\Taxonomy\Models\Description;

class ProductEntity
{
    const CONNECTION_COLUMN = 'product_id';

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getFrontendData(array $additions = []) {
        $return = [
            'id' => $this->product->id,
            'is_active' => $this->product->is_active,
            'product_type' => $this->product->type->name,
            'name' => $this->getDescriptionWithTranslationsData($this->product->name)
        ];

        return $return;
    }

    protected function getDescriptionWithTranslationsData(Description $description) {
        return (new DescriptionEntity($description))->getFrontendData();
    }

    public static function getCollection($products, array $additions = [])
    {
        $return = [];
        foreach ($products as $product) {
            $return[] = (new self($product))->getFrontendData($additions);
        }
        return $return;
    }
}