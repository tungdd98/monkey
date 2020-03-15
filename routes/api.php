<?php

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthBasic\LoginController')->name('auth.login');
    Route::post('logout', 'AuthBasic\LogoutController')->name('auth.logout');
    Route::get('users', 'Api\UserController');
});

Route::group([
    'prefix' => 'sliders'
], function() {
    Route::get('/', 'Api\SliderController@index')->name('slider.index');
    Route::get('/{id}', 'Api\SliderController@show')->name('slider.show');
    Route::patch('/{id}', 'Api\SliderController@update')->name('slider.update');
    Route::delete('/{id}', 'Api\SliderController@destroy')->name('slider.delete');
    Route::post('/', 'Api\SliderController@store')->name('slider.store');
    Route::post('/{id}', 'Api\SliderController@update')->name('slider.edit');
});


