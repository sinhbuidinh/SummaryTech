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

Route::get('/', function () {
    return view('welcome');
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

    Route::get('/create', 'ProductsController@create')->name('_create');
    Route::post('/create', 'ProductsController@create')->name('_create_post');

    Route::get('/create_type', 'ProductsController@createType')->name('_create_type');
    Route::post('/create_type', 'ProductsController@createType')->name('_create_type_post');
});

Route::prefix('customer')->namespace('Customer')->name('customer')->group(function () {
    Route::get('/list', 'CustomersController@index')->name('_list');

    Route::get('/create', 'CustomersController@create')->name('_create');
    Route::post('/create', 'CustomersController@create')->name('_create_post');
});

Route::prefix('member')->namespace('Member')->name('member')->group(function () {
    Route::get('/list', 'MembersController@index')->name('_list');

    Route::get('/create', 'MembersController@create')->name('_create');
    Route::post('/create', 'MembersController@create')->name('_create_post');
});
