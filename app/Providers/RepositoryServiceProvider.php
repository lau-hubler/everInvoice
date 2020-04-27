<?php

namespace App\Providers;

use App\Repositories\Invoice\InvoiceRepository;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Product\ProductCacheRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\Stakeholder\StakeholderCacheRepository;
use App\Repositories\Stakeholder\StakeholderRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductCacheRepository::class);
        $this->app->bind(StakeholderRepositoryInterface::class, StakeholderCacheRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
