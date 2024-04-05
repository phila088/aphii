<?php

namespace App\Http\Controllers;

use App\Models\ContactDepartment;
use Illuminate\Http\Request;

class ContactDepartmentController
{
    public function index()
    {
        return ContactDepartment::all();
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
