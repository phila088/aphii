<?php

namespace App\Http\Controllers\Employee;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', City::class);

        return City::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', City::class);

        $data = $request->validate([

        ]);

        return City::create($data);
    }

    public function show(City $city)
    {
        $this->authorize('view', $city);

        return $city;
    }

    public function update(Request $request, City $city)
    {
        $this->authorize('update', $city);

        $data = $request->validate([

        ]);

        $city->update($data);

        return $city;
    }

    public function destroy(City $city)
    {
        $this->authorize('delete', $city);

        $city->delete();

        return response()->json();
    }
}
