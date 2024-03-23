<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandAddress;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandAddressController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandAddress::class);

        return BrandAddress::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandAddress::class);

        $data = $request->validate([

        ]);

        return BrandAddress::create($data);
    }

    public function show(BrandAddress $brandAddress)
    {
        $this->authorize('view', $brandAddress);

        return $brandAddress;
    }

    public function update(Request $request, BrandAddress $brandAddress)
    {
        $this->authorize('update', $brandAddress);

        $data = $request->validate([

        ]);

        $brandAddress->update($data);

        return $brandAddress;
    }

    public function destroy(BrandAddress $brandAddress)
    {
        $this->authorize('delete', $brandAddress);

        $brandAddress->delete();

        return response()->json();
    }
}
