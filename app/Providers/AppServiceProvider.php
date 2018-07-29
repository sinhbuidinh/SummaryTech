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
        date_default_timezone_set(DEFAULT_TIMEZONE);
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
        $this->app->bind('member_service', 'App\Services\MemberService');
        $this->app->bind('order_service', 'App\Services\OrderService');
        $this->app->bind('order_export_service', 'App\Services\OrderExportService');
        $this->app->bind('wood_type_service', 'App\Services\WoodTypeService');
        $this->app->bind('order_import_service', 'App\Services\OrderImportService');
    }
}
