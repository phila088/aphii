<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Vendor::class);

        return Vendor::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Vendor::class);

        $data = $request->validate([

        ]);

        return Vendor::create($data);
    }

    public function show(Vendor $vendor)
    {
        $this->authorize('view', $vendor);

        return $vendor;
    }

    public function update(Request $request, Vendor $vendor)
    {
        $this->authorize('update', $vendor);

        $data = $request->validate([

        ]);

        $vendor->update($data);

        return $vendor;
    }

    public function destroy(Vendor $vendor)
    {
        $this->authorize('delete', $vendor);

        $vendor->delete();

        return response()->json();
    }
}
