<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'locale' => config('placetoPay.locale'),
            'payer' => [
                'name' => $this->user->name ,
                'surname' => $this->user->surname,
                'email' => $this->user->email,
                'documentType' => $this->invoice->vendor->documentType->acronym,
                'document' => $this->invoice->vendor->document,
            ],
            'buyer' => [
                'name' => $this->invoice->client->name,
                'surname' => $this->invoice->client->surname,
                'email' => $this->invoice->client->email,
                'documentType' => $this->invoice->client->documentType->acronym,
                'document' => $this->invoice->client->document,
            ],
            'payment' => [
                'reference' => $this->reference,
                'description' => $this->description,
                'amount' => [
                    'currency' => config('placetoPay.currency'),
                    'total' => $this->amount
                ],
                'allowPartial' => config('placetoPay.allowPartial')
            ],
            'expiration' => date('c', strtotime(config('placetoPay.expiration'))),
            'ipAddress' => config('placetoPay.ipAddress'),
            'userAgent' => config('placetoPay.userAgent'),
            'returnUrl' => config('placetoPay.returnUrl'),
            'cancelUrl' => config('placetoPay.cancelUrl'),
        ];
    }
}
