<?php

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthBasic\LoginController')->name('auth.login');
    Route::post('logout', 'AuthBasic\LogoutController')->name('auth.logout');
    Route::get('users', 'Api\UserController');
});
Route::apiResource('products', 'Api\ProductsController');
