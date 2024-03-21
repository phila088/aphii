<?php

namespace App\Http\Controllers\employee;

use App\Models\Counties;
use Illuminate\Http\Request;

class CountiesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Counties::class);

        return Counties::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Counties::class);

        $data = $request->validate([

        ]);

        return Counties::create($data);
    }

    public function show(Counties $counties)
    {
        $this->authorize('view', $counties);

        return $counties;
    }

    public function update(Request $request, Counties $counties)
    {
        $this->authorize('update', $counties);

        $data = $request->validate([

        ]);

        $counties->update($data);

        return $counties;
    }

    public function destroy(Counties $counties)
    {
        $this->authorize('delete', $counties);

        $counties->delete();

        return response()->json();
    }
}
