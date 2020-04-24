<?php

namespace App\Http\Controllers;

use App\Facades\PlacetoPayFacade;
use App\Http\Resources\TransactionResource;
use App\Invoice;
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
            dd($response);
            if ($response->isSuccessful()) {
                $response->processUrl();
            } else {
                $response->status()->message();
            }

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function paymentResponse($transaction)
    {

    }
}
