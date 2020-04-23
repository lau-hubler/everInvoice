<?php

namespace App\Repositories;

use App\Invoice;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    public function all()
    {
        return Invoice::with(['vendor', 'client', 'status'])->get();
    }

    public function find($id)
    {
        return Invoice::with(['vendor.documentType', 'client.documentType', 'status', 'orders.product'])->find($id);
    }

    public function export($invoices)
    {
        $exportable = $invoices->load('client', 'vendor', 'status');
        return $exportable->map(function ($invoice) {
            return [
                'code' => $invoice->code,
                'client name' => $this->getStakeholderName($invoice->client),
                'client document' => $this->getStakeholderDocument($invoice->client),
                'vendor name' => $this->getStakeholderName($invoice->vendor),
                'vendor document' => $this->getStakeholderDocument($invoice->vendor),
                'invoice date' => $invoice->invoice_date,
                'delivery date' => $invoice->delivery_date,
                'due date' => $invoice->due_date,
                'status' => $invoice->status->name
            ];
        });
    }

    protected function getStakeholderName($stakeholder): string
    {
        if ($stakeholder->is_company) {
            return "$stakeholder->company ($stakeholder->name)";
        }

        return $stakeholder->name . ' ' . $stakeholder->surname;
    }

    protected function getStakeholderDocument($stakeholder): string
    {
        return $stakeholder->documentType->acronym . ' ' . $stakeholder->document;
    }
}
