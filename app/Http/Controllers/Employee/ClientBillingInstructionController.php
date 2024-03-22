<?php

namespace App\Http\Controllers\Employee;

use App\Models\ClientBillingInstruction;
use Illuminate\Http\Request;

class ClientBillingInstructionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ClientBillingInstruction::class);

        return ClientBillingInstruction::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ClientBillingInstruction::class);

        $data = $request->validate([

        ]);

        return ClientBillingInstruction::create($data);
    }

    public function show(ClientBillingInstruction $clientBillingInstruction)
    {
        $this->authorize('view', $clientBillingInstruction);

        return $clientBillingInstruction;
    }

    public function update(Request $request, ClientBillingInstruction $clientBillingInstruction)
    {
        $this->authorize('update', $clientBillingInstruction);

        $data = $request->validate([

        ]);

        $clientBillingInstruction->update($data);

        return $clientBillingInstruction;
    }

    public function destroy(ClientBillingInstruction $clientBillingInstruction)
    {
        $this->authorize('delete', $clientBillingInstruction);

        $clientBillingInstruction->delete();

        return response()->json();
    }
}
