<?php

namespace App\Http\Controllers\employee;

use App\Models\ClientNote;
use Illuminate\Http\Request;

class ClientNoteController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ClientNote::class);

        return ClientNote::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientNote::class);

        $data = $request->validate([

        ]);

        return ClientNote::create($data);
    }

    public function show(ClientNote $clientNote)
    {
        $this->authorize('view', $clientNote);

        return $clientNote;
    }

    public function update(Request $request, ClientNote $clientNote)
    {
        $this->authorize('update', $clientNote);

        $data = $request->validate([

        ]);

        $clientNote->update($data);

        return $clientNote;
    }

    public function destroy(ClientNote $clientNote)
    {
        $this->authorize('delete', $clientNote);

        $clientNote->delete();

        return response()->json();
    }
}
