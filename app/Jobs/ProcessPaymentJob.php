<?php

namespace App\Jobs;

use App\Events\PaymentResponseEvent;
use App\Invoice;
use App\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $invoicesInProcess = Invoice::where('status_id', 7)->get();

        foreach($invoicesInProcess as $invoice) {
            $transaction = $transaction = Transaction::where('invoice_id', $invoice->id)->first();
            if ($transaction) {
                event(new PaymentResponseEvent($transaction));
            } else {
                $invoice->updateStatus();
            }
        }
    }
}
