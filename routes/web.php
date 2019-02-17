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
Route::prefix('')->namespace('Front')->name('front')->group(function () {
    Route::get('', 'IndexController@front')->name('index');
});

Route::prefix('')->namespace('Back')->name('back')->group(function () {
    Route::get('admin', 'IndexController@back')->name('_index');
    Route::post('admin', 'ArticleController@create')->name('_article_create');
    Route::get('admin/articles', 'ArticleController@listArticle')->name('_article_list');
});
