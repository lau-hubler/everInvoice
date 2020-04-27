<?php

namespace App\Http\Controllers;

use App\Events\PaymentResponseEvent;
use App\Facades\PlacetoPayFacade;
use App\Http\Resources\TransactionResource;
use App\Invoice;
use App\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function pay(Invoice $invoice)
    {
        $transaction = $invoice->pay(Auth::user());
        $request = (new TransactionResource($transaction))->jsonSerialize();

        try {
            $response = PlacetoPayFacade::get()->request($request);

            if ($response->isSuccessful()) {
                $transaction->update(['request_id' => $response->requestId]);
                return redirect($response->processUrl());
            } else {
                $transaction->update(['status_id' => 'cancelled']);
                $response->status()->message();
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function paymentResponse()
    {
        $transaction = Transaction::where('user_id', Auth::user()->id)->get()->sortDesc()->first();

        event(new PaymentResponseEvent($transaction));

        return redirect()->route('invoices.index')
            ->withSuccess('It can take a moment to process your payment depending of your pay method and operator.');
    }

    public function consultTransaction($invoice)
    {
        $transaction = Transaction::where('invoice_id', $invoice)->first();

        event(new PaymentResponseEvent($transaction));

        return redirect()->route('invoices.index');
    }

    public function reversePayment($invoice)
    {
        $transaction = Transaction::where('invoice_id', $invoice)->where('status_id', 3)->first();

        try {
            $response = PlacetoPayFacade::get()->reverse($transaction->request_id);
            if ($response->status()->isApproved()) {
                $transaction->update(['status_id' => 'cancelled']);
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }
}
