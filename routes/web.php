<?php

Route::group(['middleware' => ['pulsar.navtools']], function () {

    Route::get('/',                                                                         '\App\Http\Controllers\WebFrontendController@home')->name('web.home');
    Route::get('/es',                                                                       '\App\Http\Controllers\WebFrontendController@home')->name('web.home-es');
    Route::get('/en',                                                                       '\App\Http\Controllers\WebFrontendController@home')->name('web.home-en');

    // CMS - BLOG
    // EN
    Route::get('/en/blog',                                                                  '\App\Http\Controllers\BlogFrontendController@getBlog')->name('web.blog-en');
    Route::get('/en/blog/{slug}',                                                           '\App\Http\Controllers\BlogFrontendController@getPost')->name('web.post-en');

    // ES
    Route::get('/es/blog',                                                                  '\App\Http\Controllers\BlogFrontendController@getBlog')->name('web.blog-es');
    Route::get('/es/blog/{slug}',                                                           '\App\Http\Controllers\BlogFrontendController@getPost')->name('web.post-es');


    // REVIEWS
    // EN
    Route::get('/en/review/{slug}',                                                         '\App\Http\Controllers\ReviewFrontendController@createReview')->name('web.create_review-en');
    Route::get('/en/review/poll/{code}',                                                    '\App\Http\Controllers\ReviewFrontendController@review')->name('web.review');

    // ES
    Route::get('/es/review/{slug}',                                                         '\App\Http\Controllers\ReviewFrontendController@createReview')->name('web.create_review-es');
    Route::get('/es/review/poll/{code}',                                                    '\App\Http\Controllers\ReviewFrontendController@review')->name('web.review');

    // CUSTOMER ACCOUNT
    // EN
    Route::get('/en/account/login',                                                         '\App\Http\Controllers\CustomerFrontendController@getLogin')->name('web.login-en');
    Route::get('/en/account/sing-in',                                                       '\App\Http\Controllers\CustomerFrontendController@singIn')->name('web.sing_in-en');
    Route::get('/en/account/password',                                                      '\App\Http\Controllers\CustomerFrontendController@resetPassword')->name('web.reset_password-en');
    Route::get('/en/account/password/reset/{token}',                                        '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('web.show_reset_form-en');

    // ES
    Route::get('/es/cuenta/login',                                                          '\App\Http\Controllers\CustomerFrontendController@login')->name('web.login-es');
    Route::get('/es/cuenta/registro',                                                       '\App\Http\Controllers\CustomerFrontendController@singIn')->name('web.sing_in-es');
    Route::get('/es/cuenta/password',                                                       '\App\Http\Controllers\CustomerFrontendController@resetPassword')->name('web.reset_password-es');
    Route::get('/es/cuenta/password/reset/{token}',                                         '\App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('web.show_reset_form-es');

    //
    Route::post('/account/login',                                                           '\App\Http\Controllers\Auth\LoginController@login')->name('web.authenticate');
    Route::post('/account/create',                                                          '\App\Http\Controllers\CustomerFrontendController@createCustomer')->name('web.create_customer');
    Route::post('/account/password/email',                                                  '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('web.send_reset_link_email');
    Route::post('/account/password/reset',                                                  '\App\Http\Controllers\Auth\ResetPasswordController@reset')->name('web.password_reset');

    // MARKET ROUTES
    // EN
    Route::get('/en/products',                                                              '\App\Http\Controllers\MarketFrontendController@products')->name('web.products-en');
    Route::get('/en/product/{category}/{slug}',                                             '\App\Http\Controllers\MarketFrontendController@getProduct')->name('web.product-en');

    // ES
    Route::get('/es/productos',                                                             '\App\Http\Controllers\MarketFrontendController@products')->name('web.products-es');
    Route::get('/es/producto/{category}/{slug}',                                            '\App\Http\Controllers\MarketFrontendController@product')->name('web.product-es');

    // SHOPPING CART
    // EN
    Route::get('/en/shopping/cart',                                                         '\App\Http\Controllers\ShoppingCartController@index')->name('web.shopping_cart-en');
    Route::match(['get', 'post'], '/en/shopping/cart/add/product/{slug}',                   '\App\Http\Controllers\ShoppingCartController@addProduct')->name('web.add_shopping_cart-en');
    Route::match(['get', 'post'], '/en/shopping/cart/delete/product/{rowId}',               '\App\Http\Controllers\ShoppingCartController@deleteProduct')->name('web.delete_shopping_cart-en');
    Route::put('/en/shopping/cart/update',                                                  '\App\Http\Controllers\ShoppingCartController@update')->name('web.update_shopping_cart-en');

    // ES
    Route::get('/es/carro-compra',                                                          '\App\Http\Controllers\ShoppingCartController@index')->name('web.shopping_cart-es');
    Route::match(['get', 'post'], '/es/carro-compra/anadir-producto/{slug}',                '\App\Http\Controllers\ShoppingCartController@add')->name('web.add_shopping_cart-es');
    Route::match(['get', 'post'], '/es/carro-compra/borrar-producto/{rowId}',               '\App\Http\Controllers\ShoppingCartController@delete')->name('web.delete_shopping_cart-es');
    Route::put('/es/carro-compra/actualizar',                                               '\App\Http\Controllers\ShoppingCartController@update')->name('web.update_shopping_cart-es');


    //
});

Route::group(['middleware' => ['pulsar.navtools', 'pulsar.auth:crm']], function() {

    // CUSTOMER ACCOUNT
    // EN
    Route::match(['get', 'post'], '/en/account',                                            '\App\Http\Controllers\CustomerFrontendController@account')->name('web.account-en');
    Route::match(['get', 'post'], '/en/account/logout',                                     '\App\Http\Controllers\CustomerFrontendController@logout')->name('web.logout-en');

    // ES
    Route::match(['get', 'post'], '/es/cuenta',                                             '\App\Http\Controllers\CustomerFrontendController@account')->name('web.account-es');
    Route::match(['get', 'post'], '/es/cuenta/logout',                                      '\App\Http\Controllers\CustomerFrontendController@logout')->name('web.logout-es');

    //
    Route::put('/account/update',                                                           '\App\Http\Controllers\CustomerFrontendController@updateCustomer')->name('web.update_customer');


    // MARKET
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

// URL TESTING
Route::get('/es/ups',                                                                       '\App\Http\Controllers\WebFrontendController@ups')->name('ups');