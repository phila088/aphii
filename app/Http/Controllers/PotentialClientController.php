<?php

namespace App\Http\Controllers;

use App\Models\PotentialClient;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PotentialClientController extends Controller
{
    public function index(): View
    {
        return view('employee.potential-clients.index');
    }

    public function create(): View
    {
        return view('employee.potential-clients.create');
    }

    public function view($id)
    {
        try {
            $potentialClient = PotentialClient::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            request()->session()->flash('toast', 'Potential client could not be found.');
            request()->session()->flash('toast_type', 'error');

            return redirect()->route('employee.potential-clients.index');
        }
        return view('employee.potential-clients.view', ['potentialClient' => $potentialClient]);
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
