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
            'locale' => 'es_CO',
            'payer' => [
                'name' => $this->user->name ,
                'surname' => $this->user->surname,
                'email' => $this->user->email,
                'documentType' => $this->invoice->vendor->documentType->acronym,
                'document' => $this->invoice->vendor->document,
                'mobile' => $this->invoice->vendor->mobile,
                'address' => [
                    'street' => $this->invoice->vendor->address,
                    'city' => "",
                    'state' => "",
                    'postalCode' => "",
                    'country' => "",
                    'phone' => ""
                ]
            ],
            'buyer' => [
                'name' => $this->invoice->client->name,
                'surname' => $this->invoice->client->surname,
                'email' => $this->invoice->client->email,
                'documentType' => $this->invoice->client->documentType->acronym,
                'document' => $this->invoice->client->document,
                'mobile' => $this->invoice->client->mobile,
                'address' => [
                    'street' => $this->invoice->client->address,
                    'city' => "",
                    'state' => "",
                    'postalCode' => "",
                    'country' => "",
                    'phone' => ""
                ]
            ],
            'payment' => [
                'reference' => $this->reference,
                'description' => 'Iusto sit et voluptatem.',
                'amount' => [
                    'currency' => 'USD',
                    'total' => $this->amount
                ],
                'allowPartial' => false
            ],
            'expiration' => date('c', strtotime('+2 days')),
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36',
            'returnUrl' => 'http://127.0.0.1:8000/invoices/',
            'cancelUrl' => 'http://127.0.0.1:8000/invoices/',
            'skipResult' => false,
            'noBuyerFill' => false,
            'captureAddress' => false,
            'paymentMethod' => null
        ];
    }
}
