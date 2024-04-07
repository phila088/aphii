<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

new class extends Component {
    public Collection $roles;

    public ?Role $editing = null;

    public function mount(): void
    {
        $this->getRoles();
    }

    #[On('user-created')]
    #[On('user-updated')]
    #[On('role-created')]
    public function getRoles(): void
    {
        $this->roles = Role::orderBy('name')
            ->get();
    }

    public function edit(Role $role): void
    {
        $this->editing = $role;

        $this->getRoles();
    }

    #[On('role-edit-canceled')]
    #[On('role-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getRoles();
    }

    public function delete(Role $role): void
    {
        $role->delete();

        $this->getRoles();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($partial)) {
            $this->roles = Role::where('name', 'like', '%' . $partial . '%')
                ->orderBy('name')
                ->get();
        } else {
            $this->getRoles();
        }
    }
}; ?>

<div class="col-lg-8">
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All roles</h1>
                <x-model-search id="roles-search" model="searchTerm" />
            </div>
        </div>
        <div class="card-body">
            <div class="tw-divide-y dark:tw-divide-gray-700">
                @empty($roles[0])
                    <x-no-data />
                @else
                    @foreach ($roles as $role)
                        <div class="tw-p-6 tw-flex tw-space-x-2" wire:key="{{ $role->id }}">
                            <div class="tw-flex-1">
                                <div class="tw-flex tw-justify-between tw-items-center">
                                    <div>
                                        <p class="tw-mt-0.5 tw-text-sm tw-text-gray-900 dark:tw-text-gray-300">{{ $role->name }}</p>
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
                                            <x-dropdown-link wire:click="edit({{ $role->id }})">
                                                {{ __('Edit') }}
                                            </x-dropdown-link>
                                            <x-dropdown-link wire:click="delete({{ $role->id }})" wire:confirm="Are you sure to delete this role?">
                                                {{ __('Delete') }}
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                @if ($role->is($editing))
                                    <livewire:admin.roles.edit :role="$role" :key="$role->id" />
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
