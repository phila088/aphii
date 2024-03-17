<?php

namespace App\Http\Controllers;

use App\Models\PotentialClient;
use Illuminate\Http\Request;

class PotentialClientController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', PotentialClient::class);

        return PotentialClient::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', PotentialClient::class);

        $data = $request->validate([

        ]);

        return PotentialClient::create($data);
    }

    public function show(PotentialClient $potentialClient)
    {
        $this->authorize('view', $potentialClient);

        return $potentialClient;
    }

    public function update(Request $request, PotentialClient $potentialClient)
    {
        $this->authorize('update', $potentialClient);

        $data = $request->validate([

        ]);

        $potentialClient->update($data);

        return $potentialClient;
    }

    public function destroy(PotentialClient $potentialClient)
    {
        $this->authorize('delete', $potentialClient);

        $potentialClient->delete();

        return response()->json();
    }
}
