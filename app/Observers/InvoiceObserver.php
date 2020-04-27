<?php

namespace App\Observers;

use App\Invoice;

class InvoiceObserver
{
    /**
     * Handle the invoice before deleting event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function deleting(Invoice $invoice)
    {
        $invoice->orders()->each(function ($order) {
            $order->delete();
        });
    }
}
