<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', PaymentMethod::class);

        return PaymentMethod::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', PaymentMethod::class);

        $data = $request->validate([

        ]);

        return PaymentMethod::create($data);
    }

    public function show(PaymentMethod $paymentMethod)
    {
        $this->authorize('view', $paymentMethod);

        return $paymentMethod;
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->authorize('update', $paymentMethod);

        $data = $request->validate([

        ]);

        $paymentMethod->update($data);

        return $paymentMethod;
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $this->authorize('delete', $paymentMethod);

        $paymentMethod->delete();

        return response()->json();
    }
}
