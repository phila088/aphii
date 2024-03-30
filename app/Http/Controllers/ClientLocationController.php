<?php

namespace App\Http\Controllers;

use App\Models\ClientLocation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientLocationController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientLocation::class);

        return ClientLocation::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientLocation::class);

        $data = $request->validate([

        ]);

        return ClientLocation::create($data);
    }

    public function show(ClientLocation $clientLocation)
    {
        $this->authorize('view', $clientLocation);

        return $clientLocation;
    }

    public function update(Request $request, ClientLocation $clientLocation)
    {
        $this->authorize('update', $clientLocation);

        $data = $request->validate([

        ]);

        $clientLocation->update($data);

        return $clientLocation;
    }

    public function destroy(ClientLocation $clientLocation)
    {
        $this->authorize('delete', $clientLocation);

        $clientLocation->delete();

        return response()->json();
    }
}
