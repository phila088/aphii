<?php

namespace App\Http\Controllers;

use App\Models\VendorTrade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VendorTradeController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', VendorTrade::class);

        return VendorTrade::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', VendorTrade::class);

        $data = $request->validate([

        ]);

        return VendorTrade::create($data);
    }

    public function show(VendorTrade $vendorTrade)
    {
        $this->authorize('view', $vendorTrade);

        return $vendorTrade;
    }

    public function update(Request $request, VendorTrade $vendorTrade)
    {
        $this->authorize('update', $vendorTrade);

        $data = $request->validate([

        ]);

        $vendorTrade->update($data);

        return $vendorTrade;
    }

    public function destroy(VendorTrade $vendorTrade)
    {
        $this->authorize('delete', $vendorTrade);

        $vendorTrade->delete();

        return response()->json();
    }
}
