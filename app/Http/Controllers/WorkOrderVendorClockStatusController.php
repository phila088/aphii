<?php

namespace App\Http\Controllers;

use App\Models\WorkOrderVendorClockStatus;
use Illuminate\Http\Request;

class WorkOrderVendorClockStatusController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderVendorClockStatus::class);

        return WorkOrderVendorClockStatus::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderVendorClockStatus::class);

        $data = $request->validate([

        ]);

        return WorkOrderVendorClockStatus::create($data);
    }

    public function show(WorkOrderVendorClockStatus $workOrderVendorClockStatus)
    {
        $this->authorize('view', $workOrderVendorClockStatus);

        return $workOrderVendorClockStatus;
    }

    public function update(Request $request, WorkOrderVendorClockStatus $workOrderVendorClockStatus)
    {
        $this->authorize('update', $workOrderVendorClockStatus);

        $data = $request->validate([

        ]);

        $workOrderVendorClockStatus->update($data);

        return $workOrderVendorClockStatus;
    }

    public function destroy(WorkOrderVendorClockStatus $workOrderVendorClockStatus)
    {
        $this->authorize('delete', $workOrderVendorClockStatus);

        $workOrderVendorClockStatus->delete();

        return response()->json();
    }
}
