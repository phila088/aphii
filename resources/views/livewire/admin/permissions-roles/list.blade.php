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
            $rolesPermissions[$i]['role_id'] = $v->role_id;
            $rolesPermissions[$i]['permission'] = $permission;
            $rolesPermissions[$i]['permission_id'] = $v->permission_id;

            $i++;
        }

        $this->rolesPermission = collect($rolesPermissions);
    }

    public function delete(Role $role, Permission $permission): void
    {
        DB::table('role_has_permissions')
            ->where('role_id', '=', $role->id)
            ->where('permission_id', '=', $permission->id)
            ->delete();

        $this->getRolesPermissions();

        $this->dispatch('roles-permissions-deleted');
    }
}; ?>

<div class="tw-shadow-md tw-rounded-lg tw-p-4">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-2 tw-shadow-md tw-rounded-lg tw-p-4">
        <div></div>
        <div>
            <label for="search" class="sr-only">Search</label>
            <input type="text" id="search" wire:model="search" class="tw-py-3 tw-px-4 tw-block w-full tw-border-gray-200 tw-rounded-lg text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
        </div>
    </div>
    <div class="tw-mt-6 tw-shadow-sm tw-rounded-lg tw-divide-y dark:tw-divide-gray-700">
        @foreach ($rolesPermission as $rolePermission)
            <div class="tw-p-6 tw-flex tw-space-x-2" wire:key="{{ $rolePermission['role_id'] }}, {{ $rolePermission['permission_id'] }}">
                <div class="tw-flex-1">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <div>
                            <p class="tw-mt-0.5 tw-text-sm tw-text-gray-900"><p class="tw-font-bold">Role: </p>{{ $rolePermission['role']->name }}</p>
                            <p class="tw-mt-0.5 tw-text-sm tw-text-gray-900"><p class="tw-font-bold">Permission: </p>{{ $rolePermission['permission']->name }}</p>
                        </div>
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="delete({{ $rolePermission['role_id'] }}, {{ $rolePermission['permission_id'] }})" wire:confirm="Are you sure to delete this role permission?">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
