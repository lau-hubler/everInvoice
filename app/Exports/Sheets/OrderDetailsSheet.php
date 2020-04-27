<?php

namespace App\Exports\Sheets;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OrderDetailsSheet implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings, WithStrictNullComparison, WithEvents
{
    use Exportable;

    private $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders;
    }

    public function title(): string
    {
        return __('Orders');
    }

    public function headings(): array
    {
        return [
            'Invoice',
            'Quantity',
            'Product code',
            'Product',
            'Unit Price',
            'IVA'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $heading = 'A1:W1';
                $spreadsheet = 'A:W';
                $event->sheet->getDelegate()->getStyle('E')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
                $event->sheet->getDelegate()->getStyle('F')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
                $event->sheet->getDelegate()->getStyle($spreadsheet)->getFont()->setName('Arial');
                $event->sheet->getDelegate()->getStyle($heading)->getFont()->setBold(true)->setName('Arial');
                $event->sheet->getDelegate()->getStyle($heading)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($heading)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $event->sheet->getDelegate()->getStyle($spreadsheet)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        ];
    }
}
