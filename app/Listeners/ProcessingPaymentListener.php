<?php

namespace App\Listeners;

use App\Events\PaymentResponseEvent;
use App\Facades\PlacetoPayFacade;
use App\Invoice;
use Exception;


class ProcessingPaymentListener
{
    public function handle(PaymentResponseEvent $event)
    {
        $invoice = Invoice::where('id', $event->transaction->invoice_id)->first();
        try {
            $response = PlacetoPayFacade::get()->query($event->transaction->request_id);

            if ($response->status()->isApproved()){
                $event->transaction->update(['status_id' => 'paid']);
                $invoice->update(['status_id' => 3]);
            }
            if ($response->status()->isRejected()){
                $invoice->updateStatus();
                $event->transaction->update(['status_id' => $invoice->status->name]);
            }
            return $response->toArray();
        } catch (Exception $e) {
            $invoice->updateStatus();
            var_dump($e->getMessage());
        }
    }
}
