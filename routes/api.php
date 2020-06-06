<?php

/* Admin */
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'AuthBasic\LoginController')->name('auth.login');
    Route::post('logout', 'AuthBasic\LogoutController')->name('auth.logout');
    Route::post('register', 'AuthBasic\RegisterController')->name('auth.register');
    Route::get('users', 'Api\UserController');
});

Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/', 'Api\UserController@index')->name('user.index');
    Route::get('/{id}', 'Api\UserController@show')->name('user.show');
    Route::patch('/{id}', 'Api\UserController@update')->name('user.update');
    Route::delete('/{id}', 'Api\UserController@destroy')->name('user.delete');
    Route::post('/{id}', 'Api\UserController@update')->name('user.edit');
});

Route::group([
    'prefix' => 'categories',
], function () {
    Route::get('/', 'Api\CategoryController@index')->name('category.index');
    Route::get('/{id}', 'Api\CategoryController@show')->name('category.show');
    Route::patch('/{id}', 'Api\CategoryController@update')->name('category.update');
    Route::post('/', 'Api\CategoryController@store')->name('category.store');
    Route::post('/delete', 'Api\CategoryController@destroy')->name('category.delete');
    Route::post('/{id}', 'Api\CategoryController@update')->name('category.edit');
});

Route::group([
    'prefix' => 'products',
], function () {
    Route::get('/', 'Api\ProductController@index')->name('product.index');
    Route::get('/category/{id}', 'Api\ProductController@getCategoryOfItem')->name('product.category');
    Route::get('/unit/{id}', 'Api\ProductController@getUnitOfItem')->name('product.unit');
    Route::get('/supplier/{id}', 'Api\ProductController@getSupplierOfItem')->name('product.supplier');
    Route::get('/{id}', 'Api\ProductController@show')->name('product.show');
    Route::patch('/{id}', 'Api\ProductController@update')->name('product.update');
    Route::delete('/{id}', 'Api\ProductController@destroy')->name('product.delete');
    Route::post('/', 'Api\ProductController@store')->name('product.store');
    Route::post('/{id}', 'Api\ProductController@update')->name('product.edit');
});

Route::group([
    'prefix' => 'articles',
], function () {
    Route::get('/', 'Api\ArticleController@index')->name('article.index');
    Route::get('/{id}', 'Api\ArticleController@show')->name('article.show');
    Route::patch('/{id}', 'Api\ArticleController@update')->name('article.update');
    Route::delete('/{id}', 'Api\ArticleController@destroy')->name('article.delete');
    Route::post('/', 'Api\ArticleController@store')->name('article.store');
    Route::post('/{id}', 'Api\ArticleController@update')->name('article.edit');
});

Route::group([
    'prefix' => 'units',
], function () {
    Route::get('/', 'Api\UnitController@index')->name('unit.index');
    Route::get('/{id}', 'Api\UnitController@show')->name('unit.show');
    Route::patch('/{id}', 'Api\UnitController@update')->name('unit.update');
    Route::delete('/{id}', 'Api\UnitController@destroy')->name('unit.delete');
    Route::post('/', 'Api\UnitController@store')->name('unit.store');
    Route::post('/{id}', 'Api\UnitController@update')->name('unit.edit');
});

Route::group([
    'prefix' => 'system',
], function () {
    Route::get('/', 'Api\SystemController@index')->name('system.index');
    Route::post('/', 'Api\SystemController@update')->name('system.update');
});

Route::group([
    'prefix' => 'suppliers',
], function () {
    Route::get('/', 'Api\SupplierController@index')->name('supplier.index');
    Route::get('/{id}', 'Api\SupplierController@show')->name('supplier.show');
    Route::patch('/{id}', 'Api\SupplierController@update')->name('supplier.update');
    Route::delete('/{id}', 'Api\SupplierController@destroy')->name('supplier.delete');
    Route::post('/', 'Api\SupplierController@store')->name('supplier.store');
    Route::post('/{id}', 'Api\SupplierController@update')->name('supplier.edit');
});

Route::group([
    'prefix' => 'orders',
], function () {
    Route::get('/', 'Api\OrderController@index')->name('order.index');
    Route::get('/{id}', 'Api\OrderController@show')->name('supplier.show');
    Route::post('/change-status', 'Api\OrderController@changeStatus')->name('order.status');
});

Route::group([
    'prefix' => 'datatypes',
], function () {
    Route::get('/', 'Api\DataTypeController@index')->name('datatype.index');
    Route::get('/{id}', 'Api\DataTypeController@show')->name('datatype.show');
});

/* Home */
Route::group([
    'prefix' => 'tomita',
], function () {
    Route::group([
        'prefix' => 'products',
    ], function () {
        Route::get('/', 'SinglePageController@getListProducts');
        Route::get('/get-promotion', 'SinglePageController@getListProductsPromotion');
        Route::get('/get-by-category-id', 'SinglePageController@getListProductsByCategoryId');
    });
    Route::group([
        'prefix' => 'carts',
    ], function () {
        Route::post('/', 'CartController@addCart');
    });
    Route::group([
        'prefix' => 'categories',
    ], function () {
        Route::get('/', 'SinglePageController@getListCategories');
    });
    Route::group([
        'prefix' => 'articles',
    ], function () {
        Route::get('/', 'SinglePageController@getListArticles');
    });

});
