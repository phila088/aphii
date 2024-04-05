<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactDepartment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactDepartmentController
{
    public function index(): View
    {
        return view('admin.contact_departments.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return ContactDepartment::create($data);
    }

    public function show(ContactDepartment $contactDepartment)
    {
        return $contactDepartment;
    }

    public function update(Request $request, ContactDepartment $contactDepartment)
    {
        $data = $request->validate([

        ]);

        $contactDepartment->update($data);

        return $contactDepartment;
    }

    public function destroy(ContactDepartment $contactDepartment)
    {
        $contactDepartment->delete();

        return response()->json();
    }
}
