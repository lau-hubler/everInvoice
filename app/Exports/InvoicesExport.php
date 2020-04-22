<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class InvoicesExport implements FromCollection, WithStrictNullComparison
{
    use Exportable;
    private $invoices;

    public function __construct($invoices)
    {
        $this->invoices = $invoices;
    }

    public function collection()
    {
        return $this->invoices;
    }
}
