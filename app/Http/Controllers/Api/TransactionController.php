<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Invoice;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Invoice $invoice)
    {
        return Transaction::where('invoice_id', $invoice->id)->with('status')->get();
    }
}
