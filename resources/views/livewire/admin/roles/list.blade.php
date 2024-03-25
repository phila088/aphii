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

<div class="tw-shadow-md tw-rounded-lg tw-p-6">
    <h1 class="tw-text-lg">All roles</h1>
    <div class="tw-mt-6 tw-bg-white tw-shadow-sm tw-rounded-lg tw-divide-y">
        @foreach ($roles as $role)
            <div class="tw-p-6 tw-flex tw-space-x-2" wire:key="{{ $role->id }}">
                <div class="tw-flex-1">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <div>
                            <small class="ml-2 text-xs text-gray-600">{{ $role->created_at->format('j M Y, g:i a') }}</small>
                            @unless ($role->created_at->eq($role->updated_at))
                                <small class="text-xs text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless
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
                    @else
                        <p class="mt-0.5 text-sm text-gray-900">{{ $role->name }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
