<?php

namespace App\Http\Controllers\Admin;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentMethodController
{
    public function index(): View
    {
        return view('admin.payment-methods.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return PaymentMethod::create($data);
    }

    public function show(PaymentMethod $paymentMethod)
    {
        return $paymentMethod;
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $data = $request->validate([

        ]);

        $paymentMethod->update($data);

        return $paymentMethod;
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();

        return response()->json();
    }
}
