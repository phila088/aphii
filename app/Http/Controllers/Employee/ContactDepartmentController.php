<?php

namespace App\Http\Controllers\Employee;

use App\Models\ContactDepartment;
use Illuminate\Http\Request;

class ContactDepartmentController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', ContactDepartment::class);

        return ContactDepartment::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', ContactDepartment::class);

        $data = $request->validate([

        ]);

        return ContactDepartment::create($data);
    }

    public function show(ContactDepartment $contactDepartment)
    {
        $this->authorize('view', $contactDepartment);

        return $contactDepartment;
    }

    public function update(Request $request, ContactDepartment $contactDepartment)
    {
        $this->authorize('update', $contactDepartment);

        $data = $request->validate([

        ]);

        $contactDepartment->update($data);

        return $contactDepartment;
    }

    public function destroy(ContactDepartment $contactDepartment)
    {
        $this->authorize('delete', $contactDepartment);

        $contactDepartment->delete();

        return response()->json();
    }
}
