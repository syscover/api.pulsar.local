<?php

Route::group(['middleware' => ['pulsar.navtools']], function () {

    Route::get('/',                                                                         ['as' => 'home',                                'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/es',                                                                       ['as' => 'home-es',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/en',                                                                       ['as' => 'home-en',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);


    // CUSTOMER ACCOUNT
    // EN
    Route::get('/en/account/login',                                                         ['as' => 'getLogin-en',                         'uses' => '\App\Http\Controllers\CustomerFrontendController@getLogin']);
    Route::get('/en/account/sing-in',                                                       ['as' => 'getSingIn-en',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@getSingIn']);
    Route::post('/en/account/sing-in',                                                      ['as' => 'postSingIn-en',                       'uses' => '\App\Http\Controllers\CustomerFrontendController@postSingIn']);

    // ES
    Route::get('/es/cuenta/login',                                                          ['as' => 'getLogin-es',                         'uses' => '\App\Http\Controllers\CustomerFrontendController@getLogin']);
    Route::get('/es/cuenta/registro',                                                       ['as' => 'getSingIn-es',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@getSingIn']);
    Route::post('/es/cuenta/registro',                                                      ['as' => 'postSingIn-es',                       'uses' => '\App\Http\Controllers\CustomerFrontendController@postSingIn']);

    Route::post('/account/login',                                                           ['as' => 'postLogin',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@postLogin']);

    // SHOPPING CART
    // EN
    Route::get('/en/shopping/cart',                                                         ['as' => 'getShoppingCart-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/en/shopping/cart/add/product/{slug}',                   ['as' => 'postShoppingCart-en',                 'uses' => '\App\Http\Controllers\ShoppingCartController@postShoppingCart']);
    Route::match(['get', 'post'], '/en/shopping/cart/delete/product/{rowId}',               ['as' => 'deleteShoppingCart-en',               'uses' => '\App\Http\Controllers\ShoppingCartController@deleteShoppingCart']);
    Route::put('/en/shopping/cart/update',                                                  ['as' => 'putShoppingCart-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@putShoppingCart']);
    Route::post('/en/shopping/cart/check/coupon/code',                                      ['as' => 'checkCouponCode-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@checkCouponCode']);

    // ES
    Route::get('/es/carro-compra',                                                          ['as' => 'getShoppingCart-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/es/carro-compra/anadir-producto/{slug}',                ['as' => 'postShoppingCart-es',                 'uses' => '\App\Http\Controllers\ShoppingCartController@postShoppingCart']);
    Route::match(['get', 'post'], '/es/carro-compra/borrar-producto/{rowId}',               ['as' => 'deleteShoppingCart-es',               'uses' => '\App\Http\Controllers\ShoppingCartController@deleteShoppingCart']);
    Route::put('/es/carro-compra/actualizar',                                               ['as' => 'putShoppingCart-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@putShoppingCart']);
    Route::post('/es/carro-compra/comprueba/codigo/cupon',                                  ['as' => 'checkCouponCode-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@checkCouponCode']);

});

Route::group(['middleware' => ['pulsar.navtools', 'pulsar.crm.auth']], function() {

    // CUSTOMER ACCOUNT
    // EN
    Route::match(['get', 'post'], '/en/account',                                            ['as' => 'account-en',                          'uses' => '\App\Http\Controllers\CustomerFrontendController@account']);
    Route::put('/en/account/sing-in',                                                       ['as' => 'putSingIn-en',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@putSingIn']);
    Route::match(['get', 'post'], '/en/account/logout',                                     ['as' => 'logout-en',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@logout']);

    // ES
    Route::match(['get', 'post'], '/es/cuenta',                                             ['as' => 'account-es',                          'uses' => '\App\Http\Controllers\CustomerFrontendController@account']);
    Route::put('/es/cuenta/registro',                                                       ['as' => 'putSingIn-es',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@putSingIn']);
    Route::match(['get', 'post'], '/es/cuenta/logout',                                      ['as' => 'logout-es',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@logout']);

});

// Route with pulsar.tax.rule, this instance taxCountry and taxCustomerClass from data customer loged,
// necessary to show tax products according to the customer.
Route::group(['middleware' => ['pulsar.navtools', 'pulsar.tax.rule']], function () {

    // MARKET ROUTES
    // EN
    Route::get('/en/product/list',                                                          ['as' => 'productList-en',                      'uses' => '\App\Http\Controllers\MarketFrontendController@getProductsList']);
    Route::get('/en/product/{category}/{slug}',                                             ['as' => 'product-en',                          'uses' => '\App\Http\Controllers\MarketFrontendController@getProduct']);

    // ES
    Route::get('/es/producto/listado',                                                      ['as' => 'productList-es',                      'uses' => '\App\Http\Controllers\MarketFrontendController@getProductsList']);
    Route::get('/es/producto/{category}/{slug}',                                            ['as' => 'product-es',                          'uses' => '\App\Http\Controllers\MarketFrontendController@getProduct']);
});