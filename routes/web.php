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
});
