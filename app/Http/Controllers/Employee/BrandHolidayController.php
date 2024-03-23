<?php

namespace App\Http\Controllers\Employee;

use App\Models\BrandHoliday;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class BrandHolidayController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', BrandHoliday::class);

        return BrandHoliday::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', BrandHoliday::class);

        $data = $request->validate([

        ]);

        return BrandHoliday::create($data);
    }

    public function show(BrandHoliday $brandHoliday)
    {
        $this->authorize('view', $brandHoliday);

        return $brandHoliday;
    }

    public function update(Request $request, BrandHoliday $brandHoliday)
    {
        $this->authorize('update', $brandHoliday);

        $data = $request->validate([

        ]);

        $brandHoliday->update($data);

        return $brandHoliday;
    }

    public function destroy(BrandHoliday $brandHoliday)
    {
        $this->authorize('delete', $brandHoliday);

        $brandHoliday->delete();

        return response()->json();
    }
}
