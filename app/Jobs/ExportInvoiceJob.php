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
    private $user;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $invoices
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
    public function handle(): void
    {
        Notification::route('mail', $this->user->email)->notify(new ExportInvoiceNotify($this->invoices));
    }
}
