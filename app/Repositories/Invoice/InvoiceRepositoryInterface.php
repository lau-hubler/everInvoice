<?php


namespace App\Repositories\Invoice;

use App\Invoice;

interface InvoiceRepositoryInterface
{
    public function all();

    public function paginate();

    public function find($id);

    public function getOrdersOf($invoices);

    public function exportInvoices($invoices);

    public function exportOrders($invoices);
}
