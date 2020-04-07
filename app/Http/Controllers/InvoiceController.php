<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

        if(request()->wantsJson()) {
            return $invoices;
        }

        return response()->view('models.invoice', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param InvoiceRequest $request
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = Invoice::create($request->validated());

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);

    }

    /**
     * Display the specified resource.
     *
     * @param Invoice $invoice
     * @return Builder|Builder[]|Collection|Model|Response
     */
    public function show(Invoice $invoice)
    {
        return Invoice::with(['vendor.documentType', 'client.documentType', 'status', 'orders.product'])->find($invoice->id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param InvoiceRequest $request
     * @param Invoice $invoice
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return void
     * @throws Exception
     */
    public function destroy(Invoice $invoice): void
    {
        $invoice->delete();
    }
}
