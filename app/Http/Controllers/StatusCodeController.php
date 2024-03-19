<?php

namespace App\Http\Controllers;

use App\Models\StatusCode;
use Illuminate\Http\Request;

class StatusCodeController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', StatusCode::class);

        return StatusCode::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', StatusCode::class);

        $data = $request->validate([

        ]);

        return StatusCode::create($data);
    }

    public function show(StatusCode $statusCode)
    {
        $this->authorize('view', $statusCode);

        return $statusCode;
    }

    public function update(Request $request, StatusCode $statusCode)
    {
        $this->authorize('update', $statusCode);

        $data = $request->validate([

        ]);

        $statusCode->update($data);

        return $statusCode;
    }

    public function destroy(StatusCode $statusCode)
    {
        $this->authorize('delete', $statusCode);

        $statusCode->delete();

        return response()->json();
    }
}
