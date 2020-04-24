<?php

namespace App\Exports;

use App\Exports\Sheets\InvoiceDetailsSheet;
use App\Exports\Sheets\OrderDetailsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InvoicesExport implements WithMultipleSheets
{
    use Exportable;

    private $invoices;
    private $orders;

    public function __construct($invoices, $orders)
    {
        $this->invoices = $invoices;
        $this->orders = $orders;
    }

    public function sheets(): array
    {
        return [
            new InvoiceDetailsSheet($this->invoices),
            new OrderDetailsSheet($this->orders),
            ];
    }
}
