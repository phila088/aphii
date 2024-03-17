<?php

namespace App\Http\Controllers;

use App\Models\WorkOrderVendorClock;
use Illuminate\Http\Request;

class WorkOrderVendorClockController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderVendorClock::class);

        return WorkOrderVendorClock::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderVendorClock::class);

        $data = $request->validate([

        ]);

        return WorkOrderVendorClock::create($data);
    }

    public function show(WorkOrderVendorClock $workOrderVendorClock)
    {
        $this->authorize('view', $workOrderVendorClock);

        return $workOrderVendorClock;
    }

    public function update(Request $request, WorkOrderVendorClock $workOrderVendorClock)
    {
        $this->authorize('update', $workOrderVendorClock);

        $data = $request->validate([

        ]);

        $workOrderVendorClock->update($data);

        return $workOrderVendorClock;
    }

    public function destroy(WorkOrderVendorClock $workOrderVendorClock)
    {
        $this->authorize('delete', $workOrderVendorClock);

        $workOrderVendorClock->delete();

        return response()->json();
    }
}
