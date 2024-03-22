<?php

namespace App\Http\Controllers;

use App\Models\CallFollowupsw;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CallFollowupswController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', CallFollowupsw::class);

        return CallFollowupsw::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', CallFollowupsw::class);

        $data = $request->validate([

        ]);

        return CallFollowupsw::create($data);
    }

    public function show(CallFollowupsw $callFollowupsw)
    {
        $this->authorize('view', $callFollowupsw);

        return $callFollowupsw;
    }

    public function update(Request $request, CallFollowupsw $callFollowupsw)
    {
        $this->authorize('update', $callFollowupsw);

        $data = $request->validate([

        ]);

        $callFollowupsw->update($data);

        return $callFollowupsw;
    }

    public function destroy(CallFollowupsw $callFollowupsw)
    {
        $this->authorize('delete', $callFollowupsw);

        $callFollowupsw->delete();

        return response()->json();
    }
}
