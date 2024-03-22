<?php

namespace App\Http\Controllers;

use App\Models\CallFollowups;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CallFollowupsController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CallFollowups::class);

        return CallFollowups::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CallFollowups::class);

        $data = $request->validate([

        ]);

        return CallFollowups::create($data);
    }

    public function show(CallFollowups $callFollowups)
    {
        $this->authorize('view', $callFollowups);

        return $callFollowups;
    }

    public function update(Request $request, CallFollowups $callFollowups)
    {
        $this->authorize('update', $callFollowups);

        $data = $request->validate([

        ]);

        $callFollowups->update($data);

        return $callFollowups;
    }

    public function destroy(CallFollowups $callFollowups)
    {
        $this->authorize('delete', $callFollowups);

        $callFollowups->delete();

        return response()->json();
    }
}
