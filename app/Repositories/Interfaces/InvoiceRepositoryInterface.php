<?php


namespace App\Repositories\Interfaces;

use App\Invoice;

interface InvoiceRepositoryInterface
{
    public function all();

    public function find($id);

    public function export($invoices);
}
