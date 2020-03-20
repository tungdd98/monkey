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

Route::group([
    'prefix' => 'products'
], function() {
    Route::get('/', 'Api\ProductController@index')->name('product.index');
    Route::get('/category/{id}', 'Api\ProductController@getCategoryOfItem')->name('product.category');
    Route::get('/type/{id}', 'Api\ProductController@getTypeOfItem')->name('product.type');
    Route::get('/unit/{id}', 'Api\ProductController@getUnitOfItem')->name('product.unit');
    Route::get('/supplier/{id}', 'Api\ProductController@getSupplierOfItem')->name('product.supplier');
    Route::get('/{id}', 'Api\ProductController@show')->name('product.show');
    Route::patch('/{id}', 'Api\ProductController@update')->name('product.update');
    Route::delete('/{id}', 'Api\ProductController@destroy')->name('product.delete');
    Route::post('/', 'Api\ProductController@store')->name('product.store');
    Route::post('/{id}', 'Api\ProductController@update')->name('product.edit');
});

Route::group([
    'prefix' => 'types'
], function() {
    Route::get('/', 'Api\TypeController@index')->name('type.index');
    Route::get('/{id}', 'Api\TypeController@show')->name('type.show');
    Route::patch('/{id}', 'Api\TypeController@update')->name('type.update');
    Route::delete('/{id}', 'Api\TypeController@destroy')->name('type.delete');
    Route::post('/', 'Api\TypeController@store')->name('type.store');
    Route::post('/{id}', 'Api\TypeController@update')->name('type.edit');
});

Route::group([
    'prefix' => 'articles'
], function() {
    Route::get('/', 'Api\ArticleController@index')->name('article.index');
    Route::get('/{id}', 'Api\ArticleController@show')->name('article.show');
    Route::patch('/{id}', 'Api\ArticleController@update')->name('article.update');
    Route::delete('/{id}', 'Api\ArticleController@destroy')->name('article.delete');
    Route::post('/', 'Api\ArticleController@store')->name('article.store');
    Route::post('/{id}', 'Api\ArticleController@update')->name('article.edit');
});

Route::group([
    'prefix' => 'units'
], function() {
    Route::get('/', 'Api\UnitController@index')->name('unit.index');
    Route::get('/{id}', 'Api\UnitController@show')->name('unit.show');
    Route::patch('/{id}', 'Api\UnitController@update')->name('unit.update');
    Route::delete('/{id}', 'Api\UnitController@destroy')->name('unit.delete');
    Route::post('/', 'Api\UnitController@store')->name('unit.store');
    Route::post('/{id}', 'Api\UnitController@update')->name('unit.edit');
});

Route::group([
    'prefix' => 'suppliers'
], function() {
    Route::get('/', 'Api\SupplierController@index')->name('supplier.index');
    Route::get('/{id}', 'Api\SupplierController@show')->name('supplier.show');
    Route::patch('/{id}', 'Api\SupplierController@update')->name('supplier.update');
    Route::delete('/{id}', 'Api\SupplierController@destroy')->name('supplier.delete');
    Route::post('/', 'Api\SupplierController@store')->name('supplier.store');
    Route::post('/{id}', 'Api\SupplierController@update')->name('supplier.edit');
});
