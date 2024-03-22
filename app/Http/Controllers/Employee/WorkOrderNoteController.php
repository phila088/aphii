<?php

namespace App\Http\Controllers\Employee;

use App\Models\WorkOrderNote;
use Illuminate\Http\Request;

class WorkOrderNoteController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderNote::class);

        return WorkOrderNote::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderNote::class);

        $data = $request->validate([

        ]);

        return WorkOrderNote::create($data);
    }

    public function show(WorkOrderNote $workOrderNote)
    {
        $this->authorize('view', $workOrderNote);

        return $workOrderNote;
    }

    public function update(Request $request, WorkOrderNote $workOrderNote)
    {
        $this->authorize('update', $workOrderNote);

        $data = $request->validate([

        ]);

        $workOrderNote->update($data);

        return $workOrderNote;
    }

    public function destroy(WorkOrderNote $workOrderNote)
    {
        $this->authorize('delete', $workOrderNote);

        $workOrderNote->delete();

        return response()->json();
    }
}
