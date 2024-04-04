<?php

namespace App\Http\Controllers;

use App\Models\VendorContact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class VendorContactController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', VendorContact::class);

        return VendorContact::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', VendorContact::class);

        $data = $request->validate([

        ]);

        return VendorContact::create($data);
    }

    public function show(VendorContact $vendorContact)
    {
        $this->authorize('view', $vendorContact);

        return $vendorContact;
    }

    public function update(Request $request, VendorContact $vendorContact)
    {
        $this->authorize('update', $vendorContact);

        $data = $request->validate([

        ]);

        $vendorContact->update($data);

        return $vendorContact;
    }

    public function destroy(VendorContact $vendorContact)
    {
        $this->authorize('delete', $vendorContact);

        $vendorContact->delete();

        return response()->json();
    }
}
