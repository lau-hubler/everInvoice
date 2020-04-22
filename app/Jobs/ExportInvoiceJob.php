<?php

namespace App\Jobs;

use App\Notifications\ExportInvoiceNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ExportInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $invoices;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $invoices)
    {
        $this->user = $user;
        $this->invoices = $invoices;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::route('mail', 'admin@gmail.com')->notify(new ExportInvoiceNotify($this->invoices));
    }
}
