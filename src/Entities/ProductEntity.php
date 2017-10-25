<?php

namespace Stylers\Ecommerce\Entities;


use App\EmbedVideos;
use Stylers\Ecommerce\Models\Product;
use Stylers\Ecommerce\Models\ProductClassification;
use Stylers\Media\Models\Gallery;
use Stylers\Media\Entities\GalleryEntity;
use Stylers\Ecommerce\Models\ProductDescription;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Entities\DescriptionEntity;
use Stylers\Taxonomy\Models\Description;
use App\Category;

use Cosima\Documents\Presenters\FilePresenterInterface;

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
            'slug' => $this->product->slug,
            'is_singleton' => (bool) $this->product->is_singleton,
            'embedVideos' => $this->getEmbedVideos($this->product->id)
        ];

        //$pc = ProductClassification::where('product_id',$this->product->id)->where('taxonomy_id',\Config::get('ecommerce.category'))->first();
        //$return['category'] = ($pc) ? $pc->valueTaxonomy->name : null;
        $return['category']['id'] =  $this->product->category_id;
        $return['category']['name'] =  Category::find($this->product->category_id)->name;

        if(in_array('stock', $additions)) {
            $return['stock'] = $this->product->stock;
        }

        $return['gallery'] = $this->getGallery();
        $return['files'] = $this->getProductFiles();

        return $return;
    }

    protected function getEmbedVideos($product_id) {
        return EmbedVideos::where('product_id', $product_id)->get();
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

        $this->setSlicedLongDescription($descriptions);

        return $descriptions;
    }

    protected function setSlicedLongDescription(&$descriptions)
    {
        if (!empty($descriptions['long_description']))
        {
            foreach ($descriptions['long_description'] as $language => $description)
            {
                $sliced = preg_split("+<hr\s/>+", $description);
                $descriptions['long_description_sliced'][$language] = $sliced;
            }
        }
    }

    protected function getGallery()
    {
        $filePresenter = app(FilePresenterInterface::class);
        $images = $filePresenter->getImages('productImages', $this->product->id);

        $gallery = [];

        foreach ($images as $image)
        {
            $item = [
                'description' => [
                    'en' => '' # @todo @ivan @2017.09.09. ez azert kell, hogy ne hasaljon el a cart megjelenitoje
                ]
            ];

            switch ($this->product->type->name)
            {
                case 'hardware':
                    $item['path'] = substr($image['productDetailUrl'], 1);
                    $item['previewUrl'] = substr($image['previewUrl'], 1);
                    $item['mainImageUrl'] = substr($image['mainImageUrl'], 1);
                    $item['bigSizeUrl'] = substr($image['bigSizeUrl'], 1);
                    $item['bigImageUrl'] = substr($image['bigImageUrl'], 1);
                    $item['galleryUrl'] = substr($image['galleryUrl'], 1);
                    $item['sliderBackgroundImageUrl'] = substr($image['sliderBackgroundImageUrl'], 1);
                    break;
                case 'course':
                    $item['path'] = substr($image['courseListUrl'], 1);
                    $item['previewUrl'] = substr($image['previewUrl'], 1);
                    $item['mainImageUrl'] = substr($image['mainImageUrl'], 1);
                    $item['bigSizeUrl'] = substr($image['bigSizeUrl'], 1);
                    $item['bigImageUrl'] = substr($image['bigImageUrl'], 1);
                    $item['galleryUrl'] = substr($image['galleryUrl'], 1);
                    $item['sliderBackgroundImageUrl'] = substr($image['sliderBackgroundImageUrl'], 1);
                    break;
            }

            $gallery['items'][] = $item;
        }

        return $gallery;
    }

    protected function getProductFiles()
    {
        $filePresenter = app(FilePresenterInterface::class);
        $fileHolder = $filePresenter->getFiles('productFiles', $this->product->id);
        $files = [];

        foreach ($fileHolder as $file)
        {
            $files['items'][]= [
                'id' => $file['id'],
                'ext' => $file['ext'],
                'name' => $file['name'],
                'size' => $file['readableSize'],
                'description' => [
                    'en' => '' # @todo @ivan @2017.09.09. ez azert kell, hogy ne hasaljon el a cart megjelenitoje
                ]
            ];
        }

        return $files;
    }

    # @todo @ivan stylers media kezelo
    /*
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
    */

    public static function getCollection($products, array $additions = [])
    {
        $return = [];
        foreach ($products as $product) {
            $return[] = (new self($product))->getFrontendData($additions);
        }
        return $return;
    }

}