<?php

Route::group(['middleware' => ['pulsar.navTools']], function () {

    Route::get('/', function () { return view('www.content.home'); });


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