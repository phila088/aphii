<?php

namespace App\Http\Controllers\Employee;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('employee.clients.index');
    }

    public function create(): View
    {
        return view('employee.clients.create');
    }

    public function view($id): view
    {
        $client = Client::where('id', '=', $id)
            ->with([
                'user',
                'clientPortal',
                'clientRate',
                'paymentTerm'
            ])
            ->limit(1)
            ->firstOrFail();
        return view('employee.clients.view', ['client' => $client]);
    }

    public function edit($id): View
    {
        $client = Client::where('id', '=', $id)
            ->with([
                'user',
                'clientPortal',
                'clientRate',
                'paymentTerm'
            ])
            ->limit(1)
            ->firstOrFail();
        return view('employee.clients.edit', ['client' => $client]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Client::class);

        $data = $request->validate([

        ]);

        return Client::create($data);
    }

    public function show(Client $client)
    {
        $this->authorize('view', $client);

        return $client;
    }

    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);

        $data = $request->validate([

        ]);

        $client->update($data);

        return $client;
    }

    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);

        $client->delete();

        return response()->json();
    }
}
