<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Stylers\Ecommerce\Entities\ProductEntity;
use Stylers\Ecommerce\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return ['success' => true, 'data' => ProductEntity::getCollection(Product::all())];
    }

    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        return ['success' => true, 'data' => (new ProductEntity($product))->getFrontendData()];
    }

    public function productList(Request $request) {
        $productList = $this->index($request);

        return View::make('productList', ['productList' => $productList]);
    }

    public function productShow(Request $request, $id)
    {
        $productData = $this->show($request, $id);
        return View::make('productShow', ['product' => $productData['data']]);
    }
}


