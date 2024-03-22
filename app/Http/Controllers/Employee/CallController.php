<?php

namespace App\Http\Controllers\Employee;

use App\Models\Call;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CallController extends Controller
{
    public function index(): View
    {
        return view('employee.calls.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Call::class);

        $data = $request->validate([

        ]);

        return Call::create($data);
    }

    public function show(Call $call)
    {
        $this->authorize('view', $call);

        return $call;
    }

    public function update(Request $request, Call $call)
    {
        $this->authorize('update', $call);

        $data = $request->validate([

        ]);

        $call->update($data);

        return $call;
    }

    public function destroy(Call $call)
    {
        $this->authorize('delete', $call);

        $call->delete();

        return response()->json();
    }
}
