<?php

Route::group([
    'middleware' => ['web'],
    'prefix' => 'ecommerce',
    'namespace' => 'Stylers\Ecommerce\Controllers'
], function () {
    Route::get('products', 'ProductController@index');
    Route::get('products/list', 'ProductController@productList');
    Route::get('product/{id}', 'ProductController@show');
});