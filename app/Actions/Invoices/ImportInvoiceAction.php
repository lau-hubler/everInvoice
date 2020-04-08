<?php


namespace App\Actions\Invoices;

use App\Imports\InvoiceImport;

class ImportInvoiceAction
{
    private $importFile;

    public function execute()
    {
        $invoicesImport = new InvoiceImport();
        $invoicesImport->import($this->importFile);

        return count($invoicesImport->toArray($this->importFile)[0]);
    }

    public function setImportFile($importFile)
    {
        $this->importFile = $importFile;

        return $this;
    }
}
