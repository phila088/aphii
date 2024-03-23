<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandProfile;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandProfileController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandProfile::class);

        return BrandProfile::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandProfile::class);

        $data = $request->validate([

        ]);

        return BrandProfile::create($data);
    }

    public function show(BrandProfile $brandProfile)
    {
        $this->authorize('view', $brandProfile);

        return $brandProfile;
    }

    public function update(Request $request, BrandProfile $brandProfile)
    {
        $this->authorize('update', $brandProfile);

        $data = $request->validate([

        ]);

        $brandProfile->update($data);

        return $brandProfile;
    }

    public function destroy(BrandProfile $brandProfile)
    {
        $this->authorize('delete', $brandProfile);

        $brandProfile->delete();

        return response()->json();
    }
}
