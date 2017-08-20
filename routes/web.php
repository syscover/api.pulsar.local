<?php

Route::group(['middleware' => ['pulsar.navtools']], function () {

    Route::get('/',                                                                         '\App\Http\Controllers\WebFrontendController@home')->name('home');
    Route::get('/es',                                                                       '\App\Http\Controllers\WebFrontendController@home')->name('home-es');
    Route::get('/en',                                                                       '\App\Http\Controllers\WebFrontendController@home')->name('home-en');

    // CMS - BLOG
    // EN
    Route::get('/en/blog',                                                                  '\App\Http\Controllers\BlogFrontendController@getBlog')->name('blog-en');
    Route::get('/en/blog/{slug}',                                                           '\App\Http\Controllers\BlogFrontendController@getArticle')->name('article-en');

    // ES
    Route::get('/es/blog',                                                                  '\App\Http\Controllers\BlogFrontendController@getBlog')->name('blog-es');
    Route::get('/es/blog/{slug}',                                                           '\App\Http\Controllers\BlogFrontendController@getArticle')->name('article-es');


    // CUSTOMER ACCOUNT
    // EN
    Route::get('/en/account/login',                                                         '\App\Http\Controllers\CustomerFrontendController@getLogin')->name('getLogin-en');
    Route::get('/en/account/sing-in',                                                       '\App\Http\Controllers\CustomerFrontendController@getSingIn')->name('getSingIn-en');

    // ES
    Route::get('/es/cuenta/login',                                                          '\App\Http\Controllers\CustomerFrontendController@getLogin')->name('getLogin-es');
    Route::get('/es/cuenta/registro',                                                       '\App\Http\Controllers\CustomerFrontendController@getSingIn')->name('getSingIn-es');

    //
    Route::post('/account/login',                                                           '\App\Http\Controllers\CustomerFrontendController@postLogin')->name('postLogin');
    Route::post('/account/sing-in',                                                         '\App\Http\Controllers\CustomerFrontendController@postSingIn')->name('postSingIn');


    // SHOPPING CART
    // EN
    Route::get('/en/shopping/cart',                                                         '\App\Http\Controllers\ShoppingCartController@getShoppingCart')->name('getShoppingCart-en');
    Route::match(['get', 'post'], '/en/shopping/cart/add/product/{slug}',                   '\App\Http\Controllers\ShoppingCartController@addProduct')->name('addProduct-en');
    Route::match(['get', 'post'], '/en/shopping/cart/delete/product/{rowId}',               '\App\Http\Controllers\ShoppingCartController@deleteProduct')->name('deleteProduct-en');
    Route::put('/en/shopping/cart/update',                                                  '\App\Http\Controllers\ShoppingCartController@updateProduct')->name('updateProduct-en');
    Route::post('/en/shopping/cart/check/coupon/code',                                      '\App\Http\Controllers\ShoppingCartController@checkCouponCode')->name('checkCouponCode-en');

    // ES
    Route::get('/es/carro-compra',                                                          '\App\Http\Controllers\ShoppingCartController@getShoppingCart')->name('getShoppingCart-es');
    Route::match(['get', 'post'], '/es/carro-compra/anadir-producto/{slug}',                '\App\Http\Controllers\ShoppingCartController@addProduct')->name('addProduct-es');
    Route::match(['get', 'post'], '/es/carro-compra/borrar-producto/{rowId}',               '\App\Http\Controllers\ShoppingCartController@deleteProduct')->name('deleteProduct-es');
    Route::put('/es/carro-compra/actualizar',                                               '\App\Http\Controllers\ShoppingCartController@updateProduct')->name('updateProduct-es');
    Route::post('/es/carro-compra/comprueba/codigo/cupon',                                  '\App\Http\Controllers\ShoppingCartController@checkCouponCode')->name('checkCouponCode-es');

    //
});

Route::group(['middleware' => ['pulsar.navtools', 'pulsar.crm.auth']], function() {

    // CUSTOMER ACCOUNT
    // EN
    Route::match(['get', 'post'], '/en/account',                                            '\App\Http\Controllers\CustomerFrontendController@account')->name('account-en');
    Route::match(['get', 'post'], '/en/account/logout',                                     '\App\Http\Controllers\CustomerFrontendController@logout')->name('logout-en');

    // ES
    Route::match(['get', 'post'], '/es/cuenta',                                             '\App\Http\Controllers\CustomerFrontendController@account')->name('account-es');
    Route::match(['get', 'post'], '/es/cuenta/logout',                                      '\App\Http\Controllers\CustomerFrontendController@logout')->name('logout-es');

    //
    Route::put('/account/sing-in',                                                          '\App\Http\Controllers\CustomerFrontendController@putSingIn')->name('putSingIn');


    // CHECKOUT
    // EN
    Route::get('/en/checkout/shipping',                                                     '\App\Http\Controllers\MarketFrontendController@getCheckout01')->name('getCheckout01-en');
    Route::post('/en/checkout/shipping',                                                    '\App\Http\Controllers\MarketFrontendController@postCheckout01')->name('postCheckout01-en');
    Route::get('/en/checkout/invoice',                                                      '\App\Http\Controllers\MarketFrontendController@getCheckout02')->name('getCheckout02-en');
    Route::post('/en/checkout/invoice',                                                     '\App\Http\Controllers\MarketFrontendController@postCheckout02')->name('postCheckout02-en');
    Route::get('/en/checkout/payment',                                                      '\App\Http\Controllers\MarketFrontendController@getCheckout03')->name('getCheckout03-en');
    Route::post('/en/checkout/payment',                                                     '\App\Http\Controllers\MarketFrontendController@postCheckout03')->name('postCheckout03-en');

    // ES
    Route::get('/es/realizar/pedido/envio',                                                 '\App\Http\Controllers\MarketFrontendController@getCheckout01')->name('getCheckout01-es');
    Route::post('/es/realizar/pedido/envio',                                                '\App\Http\Controllers\MarketFrontendController@postCheckout01')->name('postCheckout01-es');
    Route::get('/es/realizar/pedido/factura',                                               '\App\Http\Controllers\MarketFrontendController@getCheckout02')->name('getCheckout02-es');
    Route::post('/es/realizar/pedido/factura',                                              '\App\Http\Controllers\MarketFrontendController@postCheckout02')->name('postCheckout02-es');
    Route::get('/es/realizar/pedido/pago',                                                  '\App\Http\Controllers\MarketFrontendController@getCheckout03')->name('getCheckout03-es');
    Route::post('/es/realizar/pedido/pago',                                                 '\App\Http\Controllers\MarketFrontendController@postCheckout03')->name('postCheckout03-es');

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