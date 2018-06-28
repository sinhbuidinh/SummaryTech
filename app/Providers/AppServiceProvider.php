<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('article_type_service', 'App\Services\ArticleTypeService');
        $this->app->bind('product_service', 'App\Services\ProductService');
        $this->app->bind('product_type_service', 'App\Services\ProductTypeService');
        $this->app->bind('customer_service', 'App\Services\CustomerService');
    }
}
