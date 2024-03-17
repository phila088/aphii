<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Invoice::class);

        return Invoice::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Invoice::class);

        $data = $request->validate([

        ]);

        return Invoice::create($data);
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return $invoice;
    }

    public function update(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);

        $data = $request->validate([

        ]);

        $invoice->update($data);

        return $invoice;
    }

    public function destroy(Invoice $invoice)
    {
        $this->authorize('delete', $invoice);

        $invoice->delete();

        return response()->json();
    }
}
