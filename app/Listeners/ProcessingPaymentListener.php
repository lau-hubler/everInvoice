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
        try {
            $response = PlacetoPayFacade::get()->query($event->transaction->request_id);

            if ($response->status()->isApproved()){
                $event->transaction->update(['status_id' => 'paid']);
                Invoice::where('id', $event->transaction->invoice_id)->first()->update(['status_id' => 3]);
            }
            if ($response->status()->isRejected()){
                $event->transaction->update(['status_id' => 'cancelled']);
            }
            return $response->toArray();
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
