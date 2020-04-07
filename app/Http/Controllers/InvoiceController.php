<?php

namespace App\Http\Controllers;

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
}
