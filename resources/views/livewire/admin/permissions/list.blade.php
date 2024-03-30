<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

new class extends Component {
    public $permissions;

    public ?Permission $editing = null;

    public string $search;

    public function mount(): void
    {
        $this->getPermissions();
    }

    #[On('user-created')]
    #[On('user-updated')]
    #[On('permission-created')]
    public function getPermissions(): void
    {
        $this->search = '';

        $this->permissions = Permission::orderBy('name')
            ->get();
    }

    public function edit(Permission $permission): void
    {
        $this->editing = $permission;

        $this->getPermissions();
    }

    #[On('permission-edit-canceled')]
    #[On('permission-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getPermissions();
    }

    public function delete(Permission $permission): void
    {
        $permission->delete();

        $this->getPermissions();
    }

    public function searchResults(string $partial)
    {
        if (!empty($partial)) {
            $this->permissions = Permission::where('name', 'like', '%' . $partial . '%')
                ->get();
        } else {
            $this->getPermissions();
        }
    }
}; ?>

<div class="col-lg-8">
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All permissions</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="list-users-search" wire:model="search" class="tw-py-2 tw-px-3 tw-block tw-w-full tw-border-gray-200 tw-rounded-full tw-text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
    </div>
    <div class="card custom-card">
        <div class="card-body">
            <div class="tw-divide-y dark:tw-divide-gray-700">
                @empty($permissions[0])
                    <x-no-data />
                @else
                    @foreach ($permissions as $permission)
                        <div class="tw-p-2 tw-flex tw-space-x-2" wire:key="{{ $permission->id }}">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <p>{{ $permission->name }}</p>
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

                                            <x-dropdown-link wire:click="delete({{ $permission->id }})" wire:confirm="Are you sure to delete this permission?">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                @if ($permission->is($editing))
                                    <livewire:admin.permissions.edit :permission="$permission" :key="$permission->id" />
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endempty
            </div>
        </div>
    </div>
</div>
