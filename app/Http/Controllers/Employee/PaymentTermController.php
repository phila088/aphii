<?php

namespace App\Http\Controllers\Employee;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentTermController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', PaymentTerm::class);

        return PaymentTerm::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', PaymentTerm::class);

        $data = $request->validate([

        ]);

        return PaymentTerm::create($data);
    }

    public function show(PaymentTerm $paymentTerm)
    {
        $this->authorize('view', $paymentTerm);

        return $paymentTerm;
    }

    public function update(Request $request, PaymentTerm $paymentTerm)
    {
        $this->authorize('update', $paymentTerm);

        $data = $request->validate([

        ]);

        $paymentTerm->update($data);

        return $paymentTerm;
    }

    public function destroy(PaymentTerm $paymentTerm)
    {
        $this->authorize('delete', $paymentTerm);

        $paymentTerm->delete();

        return response()->json();
    }
}
