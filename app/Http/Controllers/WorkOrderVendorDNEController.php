<?php

namespace App\Http\Controllers;

use App\Models\WorkOrderVendorDNE;
use Illuminate\Http\Request;

class WorkOrderVendorDNEController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', WorkOrderVendorDNE::class);

        return WorkOrderVendorDNE::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', WorkOrderVendorDNE::class);

        $data = $request->validate([

        ]);

        return WorkOrderVendorDNE::create($data);
    }

    public function show(WorkOrderVendorDNE $workOrderVendorDNE)
    {
        $this->authorize('view', $workOrderVendorDNE);

        return $workOrderVendorDNE;
    }

    public function update(Request $request, WorkOrderVendorDNE $workOrderVendorDNE)
    {
        $this->authorize('update', $workOrderVendorDNE);

        $data = $request->validate([

        ]);

        $workOrderVendorDNE->update($data);

        return $workOrderVendorDNE;
    }

    public function destroy(WorkOrderVendorDNE $workOrderVendorDNE)
    {
        $this->authorize('delete', $workOrderVendorDNE);

        $workOrderVendorDNE->delete();

        return response()->json();
    }
}
