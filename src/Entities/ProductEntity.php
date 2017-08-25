<?php

namespace Stylers\Ecommerce\Entities;


use Stylers\Ecommerce\Models\Product;
use Stylers\Media\Models\Gallery;
use Stylers\Media\Entities\GalleryEntity;
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
            'descriptions' => $this->getProductDescriptionsData($this->product->id),
            'price' => $this->product->price,
            'is_singleton' => (bool) $this->product->is_singleton
        ];

        if(in_array('stock', $additions)) {
            $return['stock'] = $this->product->stock;
        }

        $return['gallery'] = $this->getGallery();

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

    protected function getGallery() {
        $gallery = Gallery::where('galleryable_type', Product::class)
            ->where('galleryable_id', $this->product->id)
            ->where('role_taxonomy_id', config('media.gallery_roles.frontend_gallery'))
            ->first();

        if($gallery) {
            return (new GalleryEntity($gallery))->getFrontendData();
        }

        return [];
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