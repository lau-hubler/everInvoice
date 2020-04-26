<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\PaymentResponseEvent;
use App\Listeners\ProcessingPaymentListener;
use App\Listeners\UserLoggedOut;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        PaymentResponseEvent::class => [
            ProcessingPaymentListener::class
        ],
        Logout::class => [
            UserLoggedOut::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
    }
}
