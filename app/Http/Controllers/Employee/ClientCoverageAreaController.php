<?php

namespace App\Http\Controllers\Employee;

use App\Models\ClientCoverageArea;
use Illuminate\Http\Request;

class ClientCoverageAreaController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ClientCoverageArea::class);

        return ClientCoverageArea::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientCoverageArea::class);

        $data = $request->validate([

        ]);

        return ClientCoverageArea::create($data);
    }

    public function show(ClientCoverageArea $clientCoverageArea)
    {
        $this->authorize('view', $clientCoverageArea);

        return $clientCoverageArea;
    }

    public function update(Request $request, ClientCoverageArea $clientCoverageArea)
    {
        $this->authorize('update', $clientCoverageArea);

        $data = $request->validate([

        ]);

        $clientCoverageArea->update($data);

        return $clientCoverageArea;
    }

    public function destroy(ClientCoverageArea $clientCoverageArea)
    {
        $this->authorize('delete', $clientCoverageArea);

        $clientCoverageArea->delete();

        return response()->json();
    }
}
