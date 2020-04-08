<?php


namespace App\Actions\Invoices;

use App\Actions\Action;
use App\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreInvoiceAction extends Action
{
    public function storeModel(Model $invoice, Request $data): Model
    {
        $invoice->client_id = $data->input('client_id');
        $invoice->vendor_id = $data->input('vendor_id');
        $invoice->invoice_date = $data->input('invoice_date');
        $invoice->delivery_date = $data->input('delivery_date');
        $invoice->due_date = $data->input('due_date');
        $invoice->status_id = $data->input('status_id');

        $invoice->save();

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);
    }
}
