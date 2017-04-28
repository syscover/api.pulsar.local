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