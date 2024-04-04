<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentTerm;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentTermController
{
    use AuthorizesRequests;

    public function index(): View
    {
        $this->authorize('paymentTerms.viewAny', PaymentTerm::class);

        return view('admin.payment-terms.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create', PaymentTerm::class);

        $data = $request->validate([

        ]);

        return PaymentTerm::create($data);
    }

    public function show(PaymentTerm $paymentTerms)
    {
        $this->authorize('view', $paymentTerms);

        return $paymentTerms;
    }

    public function update(Request $request, PaymentTerm $paymentTerms)
    {
        $this->authorize('update', $paymentTerms);

        $data = $request->validate([

        ]);

        $paymentTerms->update($data);

        return $paymentTerms;
    }

    public function destroy(PaymentTerm $paymentTerms)
    {
        $this->authorize('delete', $paymentTerms);

        $paymentTerms->delete();

        return response()->json();
    }
}
