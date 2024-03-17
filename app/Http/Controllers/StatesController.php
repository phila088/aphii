<?php

namespace App\Http\Controllers;

use App\Models\States;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', States::class);

        return States::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', States::class);

        $data = $request->validate([

        ]);

        return States::create($data);
    }

    public function show(States $states)
    {
        $this->authorize('view', $states);

        return $states;
    }

    public function update(Request $request, States $states)
    {
        $this->authorize('update', $states);

        $data = $request->validate([

        ]);

        $states->update($data);

        return $states;
    }

    public function destroy(States $states)
    {
        $this->authorize('delete', $states);

        $states->delete();

        return response()->json();
    }
}
