<?php

namespace App\Http\Controllers\employee;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Dashboard::class);

        return Dashboard::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Dashboard::class);

        $data = $request->validate([

        ]);

        return Dashboard::create($data);
    }

    public function show(Dashboard $dashboard)
    {
        $this->authorize('view', $dashboard);

        return $dashboard;
    }

    public function update(Request $request, Dashboard $dashboard)
    {
        $this->authorize('update', $dashboard);

        $data = $request->validate([

        ]);

        $dashboard->update($data);

        return $dashboard;
    }

    public function destroy(Dashboard $dashboard)
    {
        $this->authorize('delete', $dashboard);

        $dashboard->delete();

        return response()->json();
    }
}
