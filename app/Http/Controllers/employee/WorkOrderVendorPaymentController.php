<?php

namespace App\Http\Controllers\employee;

use App\Models\WorkOrderVendorPayment;
use Illuminate\Http\Request;

class WorkOrderVendorPaymentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderVendorPayment::class);

        return WorkOrderVendorPayment::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderVendorPayment::class);

        $data = $request->validate([

        ]);

        return WorkOrderVendorPayment::create($data);
    }

    public function show(WorkOrderVendorPayment $workOrderVendorPayment)
    {
        $this->authorize('view', $workOrderVendorPayment);

        return $workOrderVendorPayment;
    }

    public function update(Request $request, WorkOrderVendorPayment $workOrderVendorPayment)
    {
        $this->authorize('update', $workOrderVendorPayment);

        $data = $request->validate([

        ]);

        $workOrderVendorPayment->update($data);

        return $workOrderVendorPayment;
    }

    public function destroy(WorkOrderVendorPayment $workOrderVendorPayment)
    {
        $this->authorize('delete', $workOrderVendorPayment);

        $workOrderVendorPayment->delete();

        return response()->json();
    }
}
