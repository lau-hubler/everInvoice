<?php

declare(strict_types=1);

namespace App\Providers;

use App\Invoice;
use App\Observers\InvoiceObserver;
use App\Observers\RoleObserver;
use App\Role;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Invoice::observe(InvoiceObserver::class);
        Role::observe(RoleObserver::class);
        JsonResource::withoutWrapping();
    }
}
