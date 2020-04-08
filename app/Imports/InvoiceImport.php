<?php

namespace App\Imports;

use App\Invoice;
use App\Order;
use App\Product;
use App\Stakeholder;
use App\Status;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Row;

class InvoiceImport implements ToCollection, WithMappedCells, OnEachRow
{
    use Importable;
    private $invoice;
    /**
     * @inheritDoc
     */
    public function mapping(): array
    {
        return [
            'client_document_type' => 'B5',
            'client_document' => 'C5',
            'vendor_document_type' => 'F5',
            'vendor_document' => 'G5',
            'invoice_date' => 'J3',
            'delivery_date' => 'J4',
            'due_date' => 'J5',
            'status' => 'J6'
        ];
    }

    /**
     * @inheritDoc
     */
    public function collection(Collection $cells)
    {
        $client = Stakeholder::where('document', $cells['client_document'])->first();
        $vendor = Stakeholder::where('document', $cells['vendor_document'])->first();
        $status = Status::where('name', $cells['status'])->first();
        $cells['client_id'] = $client->id;
        $cells['vendor_id'] = $vendor->id;
        $cells['status_id'] = $status->id;

        Validator::make($cells->toArray(), [
            'client_id' => 'required',
            'vendor_id' => 'required|different:client_id',
        ])->validate();

        $this->invoice = Invoice::create([
            'client_id' => $cells['client_id'],
            'vendor_id' => $cells['vendor_id'],
            'invoice_date' => $cells['invoice_date'],
            'delivery_date' => $cells['delivery_date'],
            'due_date' => $cells['due_date'],
            'status_id' => $cells['status_id']
        ]);
    }

    /**
     * @inheritDoc
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();

        if ($rowIndex >= 9 && !$this->containsOnlyNull($row)) {
            $product = Product::where('code', $row[1])->first();
            $row['product_id'] = $product->id;
            $row['quantity'] = $row[0];
            $row['unit_price'] = $row[3];
            $row['product_iva'] = $row[5];

            Validator::make($row, [
                'product_id' => 'required',
                'quantity' => 'required|numeric',
                'unit_price' => 'required|numeric',
                'product_iva' => 'required|numeric'
            ])->validate();


            Order::create([
                'invoice_id' => $this->invoice->id,
                'product_id' => $row['product_id'],
                'quantity' => $row['quantity'],
                'unit_price' => $row['unit_price'],
                'product_iva' => $row['product_iva']
            ]);
        }
    }

    public function containsOnlyNull($input)
    {
        return empty(array_filter($input, static function ($a) {
            return $a !== null;
        }));
    }
}
