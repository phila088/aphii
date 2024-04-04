<?php

namespace App\Http\Controllers;

use App\Models\BrandVendor;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandVendorController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandVendor::class);

        return BrandVendor::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandVendor::class);

        $data = $request->validate([

        ]);

        return BrandVendor::create($data);
    }

    public function show(BrandVendor $brandVendors)
    {
        $this->authorize('view', $brandVendors);

        return $brandVendors;
    }

    public function update(Request $request, BrandVendor $brandVendors)
    {
        $this->authorize('update', $brandVendors);

        $data = $request->validate([

        ]);

        $brandVendors->update($data);

        return $brandVendors;
    }

    public function destroy(BrandVendor $brandVendors)
    {
        $this->authorize('delete', $brandVendors);

        $brandVendors->delete();

        return response()->json();
    }
}
