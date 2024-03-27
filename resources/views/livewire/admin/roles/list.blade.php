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
    </div>
</div>
