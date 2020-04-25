<?php

namespace App\Jobs;

use App\Events\PaymentResponseEvent;
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
        $transactionsInProcess = Transaction::where('status_id', 7)->get();

        foreach($transactionsInProcess as $transaction) {
            event(new PaymentResponseEvent($transaction));
        }
    }
}
