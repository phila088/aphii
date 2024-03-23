<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandPhoneNumber;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandPhoneNumberController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandPhoneNumber::class);

        return BrandPhoneNumber::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandPhoneNumber::class);

        $data = $request->validate([

        ]);

        return BrandPhoneNumber::create($data);
    }

    public function show(BrandPhoneNumber $brandPhoneNumber)
    {
        $this->authorize('view', $brandPhoneNumber);

        return $brandPhoneNumber;
    }

    public function update(Request $request, BrandPhoneNumber $brandPhoneNumber)
    {
        $this->authorize('update', $brandPhoneNumber);

        $data = $request->validate([

        ]);

        $brandPhoneNumber->update($data);

        return $brandPhoneNumber;
    }

    public function destroy(BrandPhoneNumber $brandPhoneNumber)
    {
        $this->authorize('delete', $brandPhoneNumber);

        $brandPhoneNumber->delete();

        return response()->json();
    }
}
