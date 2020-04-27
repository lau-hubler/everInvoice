<?php

namespace App\Http\Controllers;

use App\Actions\Invoices\ImportInvoiceAction;
use App\Exports\InvoicesExport;
use App\Http\Requests\ImportInvoiceRequest;
use App\Invoice;
use App\Jobs\ExportInvoiceJob;
use App\Notifications\ExportInvoiceNotify;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use App\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvoiceController extends Controller
{
    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        Gate::authorize('viewAny', Invoice::class);

        return response()->view('invoice.index');
    }

    /**
     * @param ImportInvoiceRequest $request
     * @param ImportInvoiceAction $action
     * @return mixed
     */
    public function import(ImportInvoiceRequest $request, ImportInvoiceAction $action)
    {
        $importedInvoices = $action->setImportFile($request->file('import_file'))->execute();

        Gate::authorize('import', Invoice::class);

        return redirect()->route('invoices.index')->withSuccess("{$importedInvoices} invoices were imported!");
    }

    public function export(Request $request)
    {
        $exportableInvoices = $this->invoiceRepository;
        new ExportInvoiceNotify($exportableInvoices, $request->formatToExport);
        ExportInvoiceJob::dispatch(Auth::user(), $exportableInvoices, $request->formatToExport);

        return redirect()->route('invoices.index')
            ->withSuccess('Your exporting started! You will receive a e-mail in a few minutes');
    }
}
