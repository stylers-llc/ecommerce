<?php

Route::group([
    'middleware' => ['web'],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::get('products', 'ProductController@index');
    Route::get('products/list', 'ProductController@productList');
    Route::get('product/{id}', 'ProductController@show');
    Route::get('product/show/{id}', 'ProductController@productShow');

    Route::get('cart', 'CartController@index');
    Route::any('cart/list', 'CartController@cartList');
    Route::get('cart/add/{id}', 'CartController@add');

    Route::any('checkout', 'PaymentController@checkout');
});

// Route::post('ecommerce/checkout', 'Stylers\Ecommerce\Controllers\PaymentController@checkout');