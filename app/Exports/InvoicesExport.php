<?php

namespace App\Exports;

use App\Exports\Sheets\InvoiceDetailsSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InvoicesExport implements WithMultipleSheets
{
    use Exportable;

    private $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    public function sheets(): array
    {
        return [ new InvoiceDetailsSheet($this->invoices) ];
    }
}
