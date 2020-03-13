<?php

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthBasic\LoginController')->name('auth.login');
    Route::post('logout', 'AuthBasic\LogoutController')->name('auth.logout');
    Route::get('users', 'Api\UserController');
});
Route::apiResource('products', 'Api\ProductsController');

Route::group([
    'prefix' => 'sliders'
], function() {
    Route::get('/', 'Api\Slider@index')->name('slider.index');
    Route::get('/{id}', 'Api\Slider@show')->name('slider.show');
    Route::patch('/{id}', 'Api\Slider@update')->name('slider.update');
    Route::delete('/{id}', 'Api\Slider@destroy')->name('slider.delete');
    Route::post('/', 'Api\Slider@store')->name('slider.store');
    Route::post('/{id}', 'Api\Slider@update')->name('slider.edit');
});


