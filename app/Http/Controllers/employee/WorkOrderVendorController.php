<?php

namespace App\Http\Controllers\employee;

use App\Models\WorkOrderVendor;
use Illuminate\Http\Request;

class WorkOrderVendorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderVendor::class);

        return WorkOrderVendor::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderVendor::class);

        $data = $request->validate([

        ]);

        return WorkOrderVendor::create($data);
    }

    public function show(WorkOrderVendor $workOrderVendor)
    {
        $this->authorize('view', $workOrderVendor);

        return $workOrderVendor;
    }

    public function update(Request $request, WorkOrderVendor $workOrderVendor)
    {
        $this->authorize('update', $workOrderVendor);

        $data = $request->validate([

        ]);

        $workOrderVendor->update($data);

        return $workOrderVendor;
    }

    public function destroy(WorkOrderVendor $workOrderVendor)
    {
        $this->authorize('delete', $workOrderVendor);

        $workOrderVendor->delete();

        return response()->json();
    }
}
