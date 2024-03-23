<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandHours;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandHoursController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandHours::class);

        return BrandHours::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandHours::class);

        $data = $request->validate([

        ]);

        return BrandHours::create($data);
    }

    public function show(BrandHours $brandHours)
    {
        $this->authorize('view', $brandHours);

        return $brandHours;
    }

    public function update(Request $request, BrandHours $brandHours)
    {
        $this->authorize('update', $brandHours);

        $data = $request->validate([

        ]);

        $brandHours->update($data);

        return $brandHours;
    }

    public function destroy(BrandHours $brandHours)
    {
        $this->authorize('delete', $brandHours);

        $brandHours->delete();

        return response()->json();
    }
}
