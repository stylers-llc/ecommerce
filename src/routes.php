<?php

Route::group([
    'middleware' => ['web'],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::any('product/update/{id}', ['as'=> 'product.update', 'uses' => 'ProductController@update']);
    Route::any('product/update', 'ProductController@update');
    Route::post('product/image/upload','ProductController@imageUpload');


    Route::get('products', 'ProductController@index');
    Route::get('products/list', 'ProductController@productList');

    Route::get('products/{type}', 'ProductController@index');
    Route::get('products/list/{type}', 'ProductController@productList');

    Route::get('product/{id}', 'ProductController@show');
    Route::get('product/show/{id}', 'ProductController@productShow');
    Route::get('product/top/{type}/{number}', 'ProductController@top');


});

Route::group([
    'middleware' => ['web','auth'],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::get('cart', 'CartController@index');
    Route::any('cart/list', 'CartController@cartList')->name('ecommerce.cart.list');
    Route::get('cart/add/{id}', 'CartController@add');
    Route::get('cart/remove/{id}', 'CartController@remove');
    Route::any('checkout', 'PaymentController@checkout');
    Route::any('paymentStatus', 'PaymentController@paymentStatus');
    Route::any('success', 'PaymentController@success')->name('ecommerce.success');
});

/** @Private routes
 * Route::get('ecommerce/baskets', 'Stylers\Ecommerce\Controllers\BasketController@index');
 * Route::get('ecommerce/basket/{id}', 'Stylers\Ecommerce\Controllers\BasketController@show');
 * Route::get('ecommerce/baskets/user/{id}', 'Stylers\Ecommerce\Controllers\BasketController@userBaskets');
 * Route::get('ecommerce/baskets/paid', 'Stylers\Ecommerce\Controllers\BasketController@paidBaskets');
 */
/*
Route::group([
    'middleware' => ['web'],
], function () {
    Route::get('ecommerce/product/update', 'Stylers\Ecommerce\Controllers\ProductController@update');
});
*/
// Route::get('ecommerce/product/update/{id}', 'Stylers\Ecommerce\Controllers\ProductController@update');

/** @Test routes
 * Route::get('test/sendmail', 'Stylers\Ecommerce\Controllers\BasketController@testSendMail');
 */
