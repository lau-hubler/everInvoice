<?php

namespace App\Http\Controllers;

use App\Actions\Invoices\ImportInvoiceAction;
use App\Http\Requests\ImportInvoiceRequest;
use App\Invoice;
use App\Jobs\ExportInvoiceJob;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

        return response()->view('invoice.index', compact('invoices'));
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

    public function export(Request $request)
    {
        $invoices = Invoice::all();

        ExportInvoiceJob::dispatch(Auth::user(), $invoices, $request->formatToExport);

        return redirect()->route('invoices.index')
            ->withSuccess('Your exporting started! You will receive a e-mail in a few minutes');
    }
}
