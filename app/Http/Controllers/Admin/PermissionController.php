<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PermissionController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        return Permission::all();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $data = $request->validate([

        ]);

        return Permission::create($data);
    }

    public function show(Permission $permission)
    {
        $this->authorize('view', $permission);

        return $permission;
    }

    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $data = $request->validate([

        ]);

        $permission->update($data);

        return $permission;
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        return response()->json();
    }
}
