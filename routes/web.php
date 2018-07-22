<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return redirect(route('member_list', [], false));
});

Route::get('/ddd', 'DomainDrivenDesignController@index')->name('ddd');

Route::prefix('article')->namespace('Article')->name('article')->group(function () {
    Route::get('create_type', 'ArticleTypeController@create')->name('_create_type');
    Route::post('create_type', 'ArticleTypeController@create')->name('_create_type');

    Route::get('', 'ArticleTypeController@index')->name('_list_type');
});

Route::prefix('product')->namespace('Product')->name('product')->group(function () {
    Route::get('/', 'ProductsController@index')->name('_home');
    Route::get('/list', 'ProductsController@index')->name('_list');

    Route::get('/edit', 'ProductsController@edit')->name('_edit');
    Route::get('/delete', 'ProductsController@delete')->name('_delete');

    Route::get('/create', 'ProductsController@create')->name('_create');
    Route::post('/create', 'ProductsController@create')->name('_create_post');

    Route::get('/type_delete', 'ProductsController@deleteType')->name('_type_delete');
    Route::get('/type_edit', 'ProductsController@productTypeEdit')->name('_type_edit');
    Route::get('/type_list', 'ProductsController@productTypeList')->name('_type_list');

    Route::get('/create_type', 'ProductsController@createType')->name('_create_type');
    Route::post('/create_type', 'ProductsController@createType')->name('_create_type_post');

    Route::get('/wood_type/list', 'ProductsController@woodTypeList')->name('_wood_type_list');
    Route::get('/wood_type/edit', 'ProductsController@woodTypeEdit')->name('_wood_type_edit');
    Route::get('/wood_type/delete', 'ProductsController@woodTypeDelete')->name('_wood_type_delete');
    Route::get('/wood_type/create', 'ProductsController@woodTypeCreate')->name('_wood_type_create');
    Route::post('/wood_type/create', 'ProductsController@woodTypeCreate')->name('_wood_type_create_post');
});

Route::prefix('customer')->namespace('Customer')->name('customer')->group(function () {
    Route::get('/list', 'CustomersController@index')->name('_list');

    Route::get('/edit', 'CustomersController@edit')->name('_edit');
    Route::get('/delete', 'CustomersController@delete')->name('_delete');

    Route::get('/create', 'CustomersController@create')->name('_create');
    Route::post('/create', 'CustomersController@create')->name('_create_post');
});

Route::prefix('member')->namespace('Member')->name('member')->group(function () {
    Route::get('/list', 'MembersController@index')->name('_list');
    
    Route::get('/edit', 'MembersController@edit')->name('_edit');
    Route::get('/delete', 'MembersController@delete')->name('_delete');

    Route::get('/create', 'MembersController@create')->name('_create');
    Route::post('/create', 'MembersController@create')->name('_create_post');
});

Route::prefix('order')->namespace('Order')->name('order')->group(function () {
    Route::get('/list', 'OrdersController@index')->name('_list');

    Route::get('/edit', 'OrdersController@edit')->name('_edit');
    Route::get('/delete', 'OrdersController@delete')->name('_delete');

    Route::get('/owe', 'OrdersController@owe')->name('_owe');
    Route::post('/owe', 'OrdersController@owe')->name('_owe_post');

    Route::get('/create', 'OrdersController@create')->name('_create');
    Route::post('/create', 'OrdersController@create')->name('_create_post');

    Route::post('/export', 'OrdersController@export')->name('_export');
    Route::get('/import', 'OrdersController@import')->name('_import');
    Route::post('/import', 'OrdersController@import')->name('_import_post');
});

