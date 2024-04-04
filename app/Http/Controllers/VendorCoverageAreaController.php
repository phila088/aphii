<?php

namespace App\Http\Controllers;

use App\Models\VendorCoverageArea;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VendorCoverageAreaController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', VendorCoverageArea::class);

        return VendorCoverageArea::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', VendorCoverageArea::class);

        $data = $request->validate([

        ]);

        return VendorCoverageArea::create($data);
    }

    public function show(VendorCoverageArea $vendorCoverageArea)
    {
        $this->authorize('view', $vendorCoverageArea);

        return $vendorCoverageArea;
    }

    public function update(Request $request, VendorCoverageArea $vendorCoverageArea)
    {
        $this->authorize('update', $vendorCoverageArea);

        $data = $request->validate([

        ]);

        $vendorCoverageArea->update($data);

        return $vendorCoverageArea;
    }

    public function destroy(VendorCoverageArea $vendorCoverageArea)
    {
        $this->authorize('delete', $vendorCoverageArea);

        $vendorCoverageArea->delete();

        return response()->json();
    }
}
