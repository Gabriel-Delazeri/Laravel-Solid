<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MysqlStockRepository;
use App\Repositories\MysqlProductRepository;
use App\Repositories\Contracts\StockRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, MysqlProductRepository::class);
        $this->app->bind(StockRepositoryInterface::class, MysqlStockRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
