<?php

namespace App\Http\Controllers\Employee;

use App\Models\WorkOrderPriority;
use Illuminate\Http\Request;

class WorkOrderPriorityController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderPriority::class);

        return WorkOrderPriority::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderPriority::class);

        $data = $request->validate([

        ]);

        return WorkOrderPriority::create($data);
    }

    public function show(WorkOrderPriority $workOrderPriority)
    {
        $this->authorize('view', $workOrderPriority);

        return $workOrderPriority;
    }

    public function update(Request $request, WorkOrderPriority $workOrderPriority)
    {
        $this->authorize('update', $workOrderPriority);

        $data = $request->validate([

        ]);

        $workOrderPriority->update($data);

        return $workOrderPriority;
    }

    public function destroy(WorkOrderPriority $workOrderPriority)
    {
        $this->authorize('delete', $workOrderPriority);

        $workOrderPriority->delete();

        return response()->json();
    }
}
