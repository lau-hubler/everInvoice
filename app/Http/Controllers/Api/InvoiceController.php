<?php

namespace App\Http\Controllers\Api;

use App\Actions\Invoices\StoreInvoiceAction;
use App\Actions\Invoices\UpdateInvoiceAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\Repositories\Invoice\InvoiceRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Response;

class InvoiceController extends Controller
{
    private $invoiceRepository;

    public function __construct(InvoiceRepositoryInterface $invoiceRepository)
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->authorizeResource(Invoice::class, 'invoice');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Builder[]|Collection|Response
     */
    public function index()
    {
        return $this->invoiceRepository->all();
    }

    public function all()
    {
        return $this->invoiceRepository->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @param StoreInvoiceAction $action
     * @return Model|Response
     */
    public function store(InvoiceRequest $request, Invoice $invoice, StoreInvoiceAction $action)
    {
        return $action->execute($invoice, $request);
    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(Invoice $invoice)
    {
        return $this->invoiceRepository->find($invoice->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @param UpdateInvoiceAction $action
     * @return Model
     */
    public function update(InvoiceRequest $request, Invoice $invoice, UpdateInvoiceAction $action): Model
    {
        return $action->execute($invoice, $request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return array|Response|string
     * @throws \Exception
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return __('This invoice was successfully deleted');
    }
}
