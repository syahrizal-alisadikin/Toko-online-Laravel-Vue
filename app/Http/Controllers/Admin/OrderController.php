<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;

class OrderController extends Controller
{
    public function index()
    {
        $invoices = Invoice::latest()->when(request()->q, function ($invoices) {
            $invoices = $invoices->where('invoice', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.order.index', compact('invoices'));
    }

    /**
     * show
     *
     * @param  mixed $invoice
     * @return void
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('admin.order.show', compact('invoice'));
    }
}
