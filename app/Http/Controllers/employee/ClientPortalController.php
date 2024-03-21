<?php

namespace App\Http\Controllers\employee;

use App\Models\ClientPortal;
use Illuminate\Http\Request;

class ClientPortalController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ClientPortal::class);

        return ClientPortal::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientPortal::class);

        $data = $request->validate([

        ]);

        return ClientPortal::create($data);
    }

    public function show(ClientPortal $clientPortal)
    {
        $this->authorize('view', $clientPortal);

        return $clientPortal;
    }

    public function update(Request $request, ClientPortal $clientPortal)
    {
        $this->authorize('update', $clientPortal);

        $data = $request->validate([

        ]);

        $clientPortal->update($data);

        return $clientPortal;
    }

    public function destroy(ClientPortal $clientPortal)
    {
        $this->authorize('delete', $clientPortal);

        $clientPortal->delete();

        return response()->json();
    }
}
