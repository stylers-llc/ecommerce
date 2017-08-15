<?php

namespace Stylers\Ecommerce\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Stylers\Ecommerce\Models\Basket;

class BasketController extends Controller
{
    public function index() {
        return Basket::getBaseBasketEloquent()
            ->paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $basket = Basket::getBaseBasketEloquent()
            ->with([
                'basketProducts.product' => function($query) {
                    $query->select(['id', 'price', 'name_description_id', 'type_taxonomy_id']);
                },
                'basketProducts.product.name' => function($query) {
                    $query->select(['id', 'description']);
                },
                'basketProducts.product.type' => function($query) {
                    $query->select(['id', 'name']);
                },
            ])->where('id',$id)->first();
        return $basket;
    }
}