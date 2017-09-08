<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Entities\ProductEntity;
use Stylers\Ecommerce\Manipulators\ProductSetter;
use Stylers\Ecommerce\Models\Product;
use Stylers\Media\Manipulators\FileSetter;
use Stylers\Media\Models\Gallery;
use Stylers\Media\Models\GalleryItem;
use Stylers\Taxonomy\Models\Language;
use Stylers\Taxonomy\Models\Taxonomy;

class ProductController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $typeTx = null;
        if($type) {
            try {
                $typeTx = Taxonomy::getTaxonomy($type, config('ecommerce.product_type'));
            } catch (ModelNotFoundException $ex) {}
        }

        if($typeTx) {
            $products = Product::where('type_taxonomy_id', $typeTx->id)->get();
        } else {
            $products = Product::all();
        }

        return ['success' => true, 'data' => ProductEntity::getCollection($products)];
    }

    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return ['success' => true, 'data' => (new ProductEntity($product))->getFrontendData()];
    }

    public function productList(Request $request, $type = null) {
        $productList = $this->index($request, $type);
        return View::make('productList', ['productList' => $productList]);
    }

    public function productShow(Request $request, $id)
    {
        $productData = $this->show($request, $id);
        if(is_callable(["\\App\\ProductRelation", "getRelatedProductEntities"])) {
            $relatedCourses = \App\ProductRelation::getRelatedProductEntities($id, "course");
        }

        return View::make('productShow', [
            'product' => $productData['data'],
            'relatedCourses' => $relatedCourses
        ]);
    }

    public function top(Request $request, $type = null, int $number = 4) {
        return ['success' => true, 'data' => ProductEntity::getCollection(Product::getTop((int) $number, $type))];
    }

    public function update(Request $request, $id = null) {
        $product = null;
        $isUpdate = false;

        $input = $request->all();
        if($request->isMethod('post') && !empty($input)) {
            $newProduct = (new ProductSetter($input))->set();
            if($newProduct) {
                $product = (new ProductEntity($newProduct))->getFrontendData(['stock']);
                $isUpdate = true;
            }
        } else if($id) {
            $product = (new ProductEntity(Product::findOrFail($id)))->getFrontendData(['stock']);
            $isUpdate = true;
        }

        return View::make('updateProduct', [
            'productEntity' => $product,
            'isUpdate' => $isUpdate,
            'productTypes' => Taxonomy::find(config('ecommerce.product_type'))->getLeaves(),
            'languages' => array_keys(Language::getLanguageCodes()),
            'categories' => Taxonomy::find(config('ecommerce.category'))->getLeaves(),
        ]);
    }

    public function imageUpload(Request $request) {

        $gallery = Gallery::firstOrCreate([
            'galleryable_type' => Product::class,
            'galleryable_id' => $request->id,
            'role_taxonomy_id' => config('media.gallery_roles.frontend_gallery')
        ]);

        if($request->hasFile('file')) {
            $file = (new FileSetter($request->toArray()))->setBySymfonyFile($request->file('file'));

            $galleryItem = new GalleryItem();
            $galleryItem->file_id = $file->id;
            $galleryItem->gallery_id = $gallery->id;
            $galleryItem->saveOrFail();
        }

        return \Redirect::route('product.update', $request->id);
    }

}


