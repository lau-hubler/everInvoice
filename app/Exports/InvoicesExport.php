<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class InvoicesExport implements FromCollection, WithStrictNullComparison, ShouldAutoSize, WithHeadings, WithEvents
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

    public function headings(): array
    {
        return [
            '#',
            'Code',
            'Client',
            'Vendor',
            'Invoice Date',
            'Delivery Date',
            'Due Date',
            'Status'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $cellRange = 'A1:W1';
                $spreadsheet = 'A:W';
                $event->sheet->getDelegate()->getStyle($spreadsheet)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true)->setName('Arial');
                $event->sheet->getDelegate()->getStyle($spreadsheet)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
