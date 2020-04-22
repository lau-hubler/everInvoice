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
    private $format;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $invoices
     * @param $format
     */
    public function __construct($user, $invoices, $format)
    {
        $this->user = $user;
        $this->invoices = $invoices;
        $this->format = $format;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        Notification::route('mail', $this->user->email)->notify(new ExportInvoiceNotify($this->invoices, $this->format));
    }
}
