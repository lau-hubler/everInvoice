<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Stakeholder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Http\Response
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoice = new Invoice();

        $invoice->invoice_date = $request->invoice_date;
        $invoice->delivery_date = $request->delivery_date;
        $invoice->due_date = $request->due_date;
        $invoice->status_id = $request->status_id;
        $invoice->client_id = $request->client_id;
        $invoice->vendor_id = $request->vendor_id;
        $invoice->save();

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return Invoice::with(['vendor.documentType', 'client.documentType', 'status', 'orders.product'])->find($invoice->id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $invoice->invoice_date = $request->invoice_date;
        $invoice->delivery_date = $request->delivery_date;
        $invoice->due_date = $request->due_date;
        $invoice->status_id = $request->status_id;
        $invoice->client_id = $request->client_id;
        $invoice->vendor_id = $request->vendor_id;
        $invoice->save();

        return Invoice::with(['vendor.documentType', 'client.documentType', 'status'])->find($invoice->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
    }
}
