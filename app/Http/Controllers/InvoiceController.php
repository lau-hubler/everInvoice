<?php

namespace App\Http\Controllers;

use App\Actions\Invoices\ImportInvoiceAction;
use App\Http\Requests\ImportInvoiceRequest;
use App\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        $invoices = Invoice::with(['vendor', 'client', 'status'])->get();

        return response()->view('models.invoice', compact('invoices'));
    }

    /**
     * @param ImportInvoiceRequest $request
     * @param ImportInvoiceAction $action
     * @return mixed
     */
    public function import(ImportInvoiceRequest $request, ImportInvoiceAction $action)
    {
        $importedInvoices = $action->setImportFile($request->file('import_file'))->execute();

        return redirect()->route('invoices.index')->withSuccess("{$importedInvoices} invoices were imported!");
    }
}
