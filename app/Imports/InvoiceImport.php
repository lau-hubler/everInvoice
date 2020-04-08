<?php

namespace App\Imports;

use App\Invoice;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvoiceImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;
    /**
    * @param array $row
    *
    * @return Model|null
    */
    public function model(array $row)
    {
        $invoice = new Invoice();
        $invoice->client_id = $row['client'];
        $invoice->vendor_id = $row['vendor'];
        $invoice->invoice_date = $row['invoice_date'];
        $invoice->delivery_date = $row['delivery_date'];
        $invoice->due_date = $row['due_date'];
        $invoice->status_id = $row['status'];

        return $invoice;
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            '*.invoice_date' => ['required'],
        ];
    }
}
