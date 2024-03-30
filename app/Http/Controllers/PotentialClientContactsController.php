<?php

namespace App\Http\Controllers;

use App\Models\PotentialClientContacts;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PotentialClientContactsController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', PotentialClientContacts::class);

        return PotentialClientContacts::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', PotentialClientContacts::class);

        $data = $request->validate([

        ]);

        return PotentialClientContacts::create($data);
    }

    public function show(PotentialClientContacts $potentialClientContacts)
    {
        $this->authorize('view', $potentialClientContacts);

        return $potentialClientContacts;
    }

    public function update(Request $request, PotentialClientContacts $potentialClientContacts)
    {
        $this->authorize('update', $potentialClientContacts);

        $data = $request->validate([

        ]);

        $potentialClientContacts->update($data);

        return $potentialClientContacts;
    }

    public function destroy(PotentialClientContacts $potentialClientContacts)
    {
        $this->authorize('delete', $potentialClientContacts);

        $potentialClientContacts->delete();

        return response()->json();
    }
}
