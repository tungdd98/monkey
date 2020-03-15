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

Route::group([
    'prefix' => 'categories'
], function() {
    Route::get('/', 'Api\CategoryController@index')->name('category.index');
    Route::get('/{id}', 'Api\CategoryController@show')->name('category.show');
    Route::patch('/{id}', 'Api\CategoryController@update')->name('category.update');
    Route::delete('/{id}', 'Api\CategoryController@destroy')->name('category.delete');
    Route::post('/', 'Api\CategoryController@store')->name('category.store');
    Route::post('/{id}', 'Api\CategoryController@update')->name('category.edit');
});


