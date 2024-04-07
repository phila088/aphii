<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactTitle;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactTitleController
{
    use AuthorizesRequests;

    public function index(): View
    {
        return view('admin.contact-titles.index', []);
    }

    public function store(Request $request)
    {
        $this->authorize('create', ContactTitle::class);

        $data = $request->validate([

        ]);

        return ContactTitle::create($data);
    }

    public function show(ContactTitle $contactTitle)
    {
        $this->authorize('view', $contactTitle);

        return $contactTitle;
    }

    public function update(Request $request, ContactTitle $contactTitle)
    {
        $this->authorize('update', $contactTitle);

        $data = $request->validate([

        ]);

        $contactTitle->update($data);

        return $contactTitle;
    }

    public function destroy(ContactTitle $contactTitle)
    {
        $this->authorize('delete', $contactTitle);

        $contactTitle->delete();

        return response()->json();
    }
}
