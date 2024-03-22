<?php

namespace App\Http\Controllers\Employee;

use App\Models\ContactPosition;
use Illuminate\Http\Request;

class ContactPositionController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ContactPosition::class);

        return ContactPosition::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ContactPosition::class);

        $data = $request->validate([

        ]);

        return ContactPosition::create($data);
    }

    public function show(ContactPosition $contactPosition)
    {
        $this->authorize('view', $contactPosition);

        return $contactPosition;
    }

    public function update(Request $request, ContactPosition $contactPosition)
    {
        $this->authorize('update', $contactPosition);

        $data = $request->validate([

        ]);

        $contactPosition->update($data);

        return $contactPosition;
    }

    public function destroy(ContactPosition $contactPosition)
    {
        $this->authorize('delete', $contactPosition);

        $contactPosition->delete();

        return response()->json();
    }
}
