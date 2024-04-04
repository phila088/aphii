<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController
{
    public function index()
    {
        return Vendor::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return Vendor::create($data);
    }

    public function show(Vendor $vendor)
    {
        return $vendor;
    }

    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->validate([

        ]);

        $vendor->update($data);

        return $vendor;
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return response()->json();
    }
}
