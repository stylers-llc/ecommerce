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
        return Basket::getBasketInfoById($id);
    }

    /**
     * Display user's baskets
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function userBaskets($userId)
    {
        return Basket::getBasketsInfoByUserId($userId);
    }

    public function paidBaskets() {
        return Basket::getPaidBaskets()
            ->paginate();
    }
}