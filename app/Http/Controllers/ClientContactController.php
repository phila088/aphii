<?php

namespace App\Http\Controllers;

use App\Models\ClientContact;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ClientContactController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', ClientContact::class);

        return ClientContact::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientContact::class);

        $data = $request->validate([

        ]);

        return ClientContact::create($data);
    }

    public function show(ClientContact $clientContact)
    {
        $this->authorize('view', $clientContact);

        return $clientContact;
    }

    public function update(Request $request, ClientContact $clientContact)
    {
        $this->authorize('update', $clientContact);

        $data = $request->validate([

        ]);

        $clientContact->update($data);

        return $clientContact;
    }

    public function destroy(ClientContact $clientContact)
    {
        $this->authorize('delete', $clientContact);

        $clientContact->delete();

        return response()->json();
    }
}
