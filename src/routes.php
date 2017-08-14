<?php

Route::group([
    'middleware' => [],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::get('products', 'ProductController@index');
    Route::get('products/list', 'ProductController@productList');
    Route::get('product/{id}', 'ProductController@show');
    Route::get('product/show/{id}', 'ProductController@productShow');
});

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::get('cart', 'CartController@index');
    Route::any('cart/list', 'CartController@cartList')->name('ecommerce.cart.list');
    Route::get('cart/add/{id}', 'CartController@add');
    Route::any('checkout', 'PaymentController@checkout');
    Route::any('paymentStatus', 'PaymentController@paymentStatus');
    Route::any('success', 'PaymentController@success')->name('ecommerce.success');
});