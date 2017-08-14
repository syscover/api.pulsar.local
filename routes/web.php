<?php

Route::group(['middleware' => ['pulsar.navtools']], function () {

    Route::get('/',                                                                         ['as' => 'home',                                'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/es',                                                                       ['as' => 'home-es',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/en',                                                                       ['as' => 'home-en',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);

    //Route::get('/es/404',                                                                   ['as' => '404-es',                              function () {return view('errors.404');}]);
    //Route::get('/en/404',                                                                   ['as' => '404-en',                              function () {return view('errors.404');}]);

    // CMS
    // EN
    Route::get('/en/blog',                                                                  ['as' => 'blog-en',                             'uses' => '\App\Http\Controllers\BlogFrontendController@getBlog']);
    Route::get('/en/blog/{slug}',                                                           ['as' => 'article-en',                          'uses' => '\App\Http\Controllers\BlogFrontendController@getArticle']);

    // ES
    Route::get('/es/blog',                                                                  ['as' => 'blog-es',                             'uses' => '\App\Http\Controllers\BlogFrontendController@getBlog']);
    Route::get('/es/blog/{slug}',                                                           ['as' => 'article-es',                          'uses' => '\App\Http\Controllers\BlogFrontendController@getArticle']);

    // CUSTOMER ACCOUNT
    // EN
    Route::get('/en/account/login',                                                         ['as' => 'getLogin-en',                         'uses' => '\App\Http\Controllers\CustomerFrontendController@getLogin']);
    Route::get('/en/account/sing-in',                                                       ['as' => 'getSingIn-en',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@getSingIn']);
    Route::post('/en/account/sing-in',                                                      ['as' => 'postSingIn-en',                       'uses' => '\App\Http\Controllers\CustomerFrontendController@postSingIn']);

    // ES
    Route::get('/es/cuenta/login',                                                          ['as' => 'getLogin-es',                         'uses' => '\App\Http\Controllers\CustomerFrontendController@getLogin']);
    Route::get('/es/cuenta/registro',                                                       ['as' => 'getSingIn-es',                        'uses' => '\App\Http\Controllers\CustomerFrontendController@getSingIn']);
    Route::post('/es/cuenta/registro',                                                      ['as' => 'postSingIn-es',                       'uses' => '\App\Http\Controllers\CustomerFrontendController@postSingIn']);

    Route::post('/account/login',                                                           ['as' => 'loginCustomer',                       'uses' => '\App\Http\Controllers\CustomerFrontendController@loginCustomer']);

    // SHOPPING CART
    // EN
    Route::get('/en/shopping/cart',                                                         ['as' => 'getShoppingCart-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/en/shopping/cart/add/product/{slug}',                   ['as' => 'addProduct-en',                       'uses' => '\App\Http\Controllers\ShoppingCartController@addProduct']);
    Route::match(['get', 'post'], '/en/shopping/cart/delete/product/{rowId}',               ['as' => 'deleteProduct-en',                    'uses' => '\App\Http\Controllers\ShoppingCartController@deleteProduct']);
    Route::put('/en/shopping/cart/update',                                                  ['as' => 'updateShoppingCart-en',               'uses' => '\App\Http\Controllers\ShoppingCartController@updateShoppingCart']);
    Route::post('/en/shopping/cart/check/coupon/code',                                      ['as' => 'checkCouponCode-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@checkCouponCode']);

    // ES
    Route::get('/es/carro-compra',                                                          ['as' => 'getShoppingCart-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/es/carro-compra/anadir-producto/{slug}',                ['as' => 'addProduct-es',                       'uses' => '\App\Http\Controllers\ShoppingCartController@addProduct']);
    Route::match(['get', 'post'], '/es/carro-compra/borrar-producto/{rowId}',               ['as' => 'deleteProduct-es',                    'uses' => '\App\Http\Controllers\ShoppingCartController@deleteProduct']);
    Route::put('/es/carro-compra/actualizar',                                               ['as' => 'updateShoppingCart-es',               'uses' => '\App\Http\Controllers\ShoppingCartController@updateShoppingCart']);
    Route::post('/es/carro-compra/comprueba/codigo/cupon',                                  ['as' => 'checkCouponCode-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@checkCouponCode']);
});

Route::group(['middleware' => ['pulsar.navtools', 'pulsar.crm.auth']], function() {

    // CUSTOMER ACCOUNT
    // EN
    Route::match(['get', 'post'], '/en/account',                                            ['as' => 'account-en',                          'uses' => '\App\Http\Controllers\CustomerFrontendController@account']);
    Route::put('/en/account/sing-in',                                                       ['as' => 'updateCustomer-en',                   'uses' => '\App\Http\Controllers\CustomerFrontendController@updateCustomer']);
    Route::match(['get', 'post'], '/en/account/logout',                                     ['as' => 'logout-en',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@logout']);

    // ES
    Route::match(['get', 'post'], '/es/cuenta',                                             ['as' => 'account-es',                          'uses' => '\App\Http\Controllers\CustomerFrontendController@account']);
    Route::put('/es/cuenta/registro',                                                       ['as' => 'updateCustomer-es',                   'uses' => '\App\Http\Controllers\CustomerFrontendController@updateCustomer']);
    Route::match(['get', 'post'], '/es/cuenta/logout',                                      ['as' => 'logout-es',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@logout']);

    // CHERCKOUT
    // ES
    Route::get('/es/proceso/compra',                                                        ['as' => 'getCheckout01-es',                    'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout01']);

    // EN
    Route::get('/en/checkout',                                                              ['as' => 'getCheckout01-en',                    'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout01']);

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