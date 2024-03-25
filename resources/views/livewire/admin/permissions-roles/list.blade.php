<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

new class extends Component {
    public Collection $rolesPermission;

    public function mount(): void
    {
        $this->getRolesPermissions();
    }

    #[On('roles-permission-created')]
    public function getRolesPermissions(): void
    {
        $rolesPermission = DB::table('role_has_permissions')
            ->get();

        $rolesPermissions = [];
        $i = 0;

        foreach ($rolesPermission as $v) {
            $role = Role::findById($v->role_id);
            $permission = Permission::findById($v->permission_id);

            $rolesPermissions[$i]['role'] = $role;
            $rolesPermissions[$i]['permission'] = $permission;

            $i++;
        }

        $this->rolesPermission = collect($rolesPermissions);
    }
}; ?>

<div>
    <table class="table">
        <thead>
            <tr>
                <th>Role</th>
                <th>Permission</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rolesPermission as $rolePermission)
                <tr>
                    <td>{{ $rolePermission['role']->name }}</td>
                    <td>{{ $rolePermission['permission']->name }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
