<?php

declare(strict_types=1);

namespace App\Providers;

use App\Invoice;
use App\Policies\InvoicePolicy;
use App\Policies\ProductPolicy;
use App\Policies\StakeholderPolicy;
use App\Product;
use App\Stakeholder;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\CategoryPolicy;
use App\Category;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Product::class => ProductPolicy::class,
        Stakeholder::class => StakeholderPolicy::class,
        Invoice::class => InvoicePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
