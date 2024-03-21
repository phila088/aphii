<?php

namespace App\Http\Controllers\employee;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return Contact::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Contact::class);

        $data = $request->validate([

        ]);

        return Contact::create($data);
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $data = $request->validate([

        ]);

        $contact->update($data);

        return $contact;
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();

        return response()->json();
    }
}
