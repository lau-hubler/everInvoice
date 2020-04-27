<?php

namespace App\Repositories\Invoice;

use App\Invoice;
use App\Order;
use App\Repositories\Invoice\InvoiceRepositoryInterface;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @var Invoice
     */
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function all()
    {
        return $this->invoice->withRelationships()->get();
    }

    public function paginate()
    {
        return $this->invoice->withRelationships()->paginate();
    }

    public function find($id)
    {
        return $this->invoice->completeAttributes()->find($id);
    }

    public function findAll($invoices)
    {
        return Invoice::whereIn('id', $this->getIds($invoices))->get();
    }

    public function findAllByIds($ids)
    {
        return Invoice::whereIn('id', $ids)->get();
    }

    public function getIds($invoices = null)
    {
        if (!$invoices) {
            $invoices = $this->all();
        }

        return $invoices->map(function ($invoice) {
            return $invoice->id;
        });
    }

    public function getOrdersOf($invoices)
    {
        return Order::with('invoice', 'product')->whereIn('invoice_id', $this->getIds($invoices))->get();
    }

    public function exportInvoices($invoices)
    {
        $exportable = $invoices->load('client', 'vendor', 'status')->sortBy('code');
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

    public function exportOrders($invoices)
    {
        $exportable = $this->getOrdersOf($invoices)->sortBy('invoice.code');

        return $exportable->map(function ($order) {
            return[
                'invoice code' => $order->invoice->code,
                'quantity' => $order->quantity,
                'product code' => $order->product->code,
                'product name' => $order->product->name,
                'unit price' => $order->unit_price,
                'iva' => $order->product_iva,
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
