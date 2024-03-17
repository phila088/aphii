<?php

namespace App\Http\Controllers;

use App\Models\WorkOrder;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrder::class);

        return WorkOrder::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrder::class);

        $data = $request->validate([

        ]);

        return WorkOrder::create($data);
    }

    public function show(WorkOrder $workOrder)
    {
        $this->authorize('view', $workOrder);

        return $workOrder;
    }

    public function update(Request $request, WorkOrder $workOrder)
    {
        $this->authorize('update', $workOrder);

        $data = $request->validate([

        ]);

        $workOrder->update($data);

        return $workOrder;
    }

    public function destroy(WorkOrder $workOrder)
    {
        $this->authorize('delete', $workOrder);

        $workOrder->delete();

        return response()->json();
    }
}
