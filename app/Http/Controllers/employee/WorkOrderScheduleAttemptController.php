<?php

namespace App\Http\Controllers\employee;

use App\Models\WorkOrderScheduleAttempt;
use Illuminate\Http\Request;

class WorkOrderScheduleAttemptController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderScheduleAttempt::class);

        return WorkOrderScheduleAttempt::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderScheduleAttempt::class);

        $data = $request->validate([

        ]);

        return WorkOrderScheduleAttempt::create($data);
    }

    public function show(WorkOrderScheduleAttempt $workOrderScheduleAttempt)
    {
        $this->authorize('view', $workOrderScheduleAttempt);

        return $workOrderScheduleAttempt;
    }

    public function update(Request $request, WorkOrderScheduleAttempt $workOrderScheduleAttempt)
    {
        $this->authorize('update', $workOrderScheduleAttempt);

        $data = $request->validate([

        ]);

        $workOrderScheduleAttempt->update($data);

        return $workOrderScheduleAttempt;
    }

    public function destroy(WorkOrderScheduleAttempt $workOrderScheduleAttempt)
    {
        $this->authorize('delete', $workOrderScheduleAttempt);

        $workOrderScheduleAttempt->delete();

        return response()->json();
    }
}
