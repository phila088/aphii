<?php

namespace App\Http\Controllers;

use App\Models\Trades;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class TradesController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Trades::class);

        return Trades::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Trades::class);

        $data = $request->validate([

        ]);

        return Trades::create($data);
    }

    public function show(Trades $trades)
    {
        $this->authorize('view', $trades);

        return $trades;
    }

    public function update(Request $request, Trades $trades)
    {
        $this->authorize('update', $trades);

        $data = $request->validate([

        ]);

        $trades->update($data);

        return $trades;
    }

    public function destroy(Trades $trades)
    {
        $this->authorize('delete', $trades);

        $trades->delete();

        return response()->json();
    }
}
