<?php

namespace App\Http\Controllers\Employee;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Location::class);

        return Location::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Location::class);

        $data = $request->validate([

        ]);

        return Location::create($data);
    }

    public function show(Location $location)
    {
        $this->authorize('view', $location);

        return $location;
    }

    public function update(Request $request, Location $location)
    {
        $this->authorize('update', $location);

        $data = $request->validate([

        ]);

        $location->update($data);

        return $location;
    }

    public function destroy(Location $location)
    {
        $this->authorize('delete', $location);

        $location->delete();

        return response()->json();
    }
}
