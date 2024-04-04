<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandHour;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandHoursController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandHour::class);

        return BrandHour::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandHour::class);

        $data = $request->validate([

        ]);

        return BrandHour::create($data);
    }

    public function show(BrandHour $brandHours)
    {
        $this->authorize('view', $brandHours);

        return $brandHours;
    }

    public function update(Request $request, BrandHour $brandHours)
    {
        $this->authorize('update', $brandHours);

        $data = $request->validate([

        ]);

        $brandHours->update($data);

        return $brandHours;
    }

    public function destroy(BrandHour $brandHours)
    {
        $this->authorize('delete', $brandHours);

        $brandHours->delete();

        return response()->json();
    }
}
