<?php

Route::group(['middleware' => ['pulsar.navtools']], function () {

    Route::get('/',                                                                         ['as' => 'home',                                'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/es',                                                                       ['as' => 'home-es',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);
    Route::get('/en',                                                                       ['as' => 'home-en',                             'uses' => '\App\Http\Controllers\WebFrontendController@home']);

    // CMS - BLOG
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

    Route::post('/account/login',                                                           ['as' => 'postLogin',                           'uses' => '\App\Http\Controllers\CustomerFrontendController@postLogin']);

    // SHOPPING CART
    // EN
    Route::get('/en/shopping/cart',                                                         ['as' => 'getShoppingCart-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/en/shopping/cart/add/product/{slug}',                   ['as' => 'addProduct-en',                       'uses' => '\App\Http\Controllers\ShoppingCartController@addProduct']);
    Route::match(['get', 'post'], '/en/shopping/cart/delete/product/{rowId}',               ['as' => 'deleteProduct-en',                    'uses' => '\App\Http\Controllers\ShoppingCartController@deleteProduct']);
    Route::put('/en/shopping/cart/update',                                                  ['as' => 'updateProduct-en',                    'uses' => '\App\Http\Controllers\ShoppingCartController@updateProduct']);
    Route::post('/en/shopping/cart/check/coupon/code',                                      ['as' => 'checkCouponCode-en',                  'uses' => '\App\Http\Controllers\ShoppingCartController@checkCouponCode']);

    // ES
    Route::get('/es/carro-compra',                                                          ['as' => 'getShoppingCart-es',                  'uses' => '\App\Http\Controllers\ShoppingCartController@getShoppingCart']);
    Route::match(['get', 'post'], '/es/carro-compra/anadir-producto/{slug}',                ['as' => 'addProduct-es',                       'uses' => '\App\Http\Controllers\ShoppingCartController@addProduct']);
    Route::match(['get', 'post'], '/es/carro-compra/borrar-producto/{rowId}',               ['as' => 'deleteProduct-es',                    'uses' => '\App\Http\Controllers\ShoppingCartController@deleteProduct']);
    Route::put('/es/carro-compra/actualizar',                                               ['as' => 'updateProduct-es',                    'uses' => '\App\Http\Controllers\ShoppingCartController@updateProduct']);
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

    // CHERCKOUT
    // EN
    Route::get('/en/checkout/shipping',                                                     ['as' => 'getCheckout01-en',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout01']);
    Route::post('/en/checkout/shipping',                                                    ['as' => 'postCheckout01-en',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout01']);
    Route::get('/en/checkout/invoice',                                                      ['as' => 'getCheckout02-en',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout02']);
    Route::post('/en/checkout/invoice',                                                     ['as' => 'postCheckout02-en',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout02']);
    Route::get('/en/checkout/payment',                                                      ['as' => 'getCheckout03-en',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout03']);
    Route::post('/en/checkout/payment',                                                     ['as' => 'postCheckout03-en',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout03']);

    // ES
    Route::get('/es/realizar/pedido/envio',                                                 ['as' => 'getCheckout01-es',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout01']);
    Route::post('/es/realizar/pedido/envio',                                                ['as' => 'postCheckout01-es',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout01']);
    Route::get('/es/realizar/pedido/factura',                                               ['as' => 'getCheckout02-es',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout02']);
    Route::post('/es/realizar/pedido/factura',                                              ['as' => 'postCheckout02-es',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout02']);
    Route::get('/es/realizar/pedido/pago',                                                  ['as' => 'getCheckout03-es',            'uses' => '\App\Http\Controllers\MarketFrontendController@getCheckout03']);
    Route::post('/es/realizar/pedido/pago',                                                 ['as' => 'postCheckout03-es',           'uses' => '\App\Http\Controllers\MarketFrontendController@postCheckout03']);

});

// Route with pulsar.tax.rule, this instance taxCountry and taxCustomerClass from data customer loged,
// necessary to show tax products according to the customer.
Route::group(['middleware' => ['pulsar.navtools', 'pulsar.tax.rule']], function () {

    // MARKET ROUTES
    // EN
    Route::get('/en/products',                                                              '\App\Http\Controllers\MarketFrontendController@getProducts')->name('getProducts-en');
    Route::get('/en/product/{category}/{slug}',                                             '\App\Http\Controllers\MarketFrontendController@getProduct')->name('getProduct-en');

    // ES
    Route::get('/es/products',                                                              '\App\Http\Controllers\MarketFrontendController@getProducts')->name('getProducts-es');
    Route::get('/es/producto/{category}/{slug}',                                            '\App\Http\Controllers\MarketFrontendController@getProduct')->name('getProduct-es');
});