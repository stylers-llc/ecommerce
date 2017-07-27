<?php

namespace Stylers\Ecommerce\Entities;


use Stylers\Ecommerce\Models\Product;
use Stylers\Ecommerce\Models\ProductDescription;
use Stylers\Taxonomy\Entities\DescriptionEntity;
use Stylers\Taxonomy\Models\Description;

class ProductEntity
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getFrontendData(array $additions = []) {
        $return = [
            'id' => $this->product->id,
            'is_active' => (bool) $this->product->is_active,
            'product_type' => $this->product->type->name,
            'name' => $this->getDescriptionWithTranslationsData($this->product->name),
            'descriptions' => $this->getProductDescriptionsData($this->product->id)
        ];

        return $return;
    }

    protected function getDescriptionWithTranslationsData(Description $description) {
        return (new DescriptionEntity($description))->getFrontendData();
    }

    protected function getProductDescriptionsData($product_id) {
        $descriptions = [];
        $productDescriptions = ProductDescription::where('product_id', $product_id)->get();

        foreach ($productDescriptions as $productDescription) {
            $descriptions[$productDescription->descriptionTaxonomy->name] = $this->getDescriptionWithTranslationsData($productDescription->description);
        }
        return $descriptions;
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