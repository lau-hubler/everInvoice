<?php


namespace App\Actions\Invoices;

use App\Actions\Action;
use App\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateInvoiceAction extends Action
{
    public function storeModel(Model $invoice, Request $data): Model
    {
        $invoice->update($data->validated());

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);
    }
}
