<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Entities\ProductEntity;
use Stylers\Ecommerce\Models\Product;
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
        return View::make('productShow', ['product' => $productData['data']]);
    }

    public function top(Request $request, $type = null) {
        return ['success' => true, 'data' => ProductEntity::getCollection(Product::getTop(5, $type))];
    }

    public function update(Request $request, $id = null) {
        $product = null;
        if($id) {
            $product = Product::find($id);
        }

        return View::make('updateProduct', ['product' => $product]);
    }
}


