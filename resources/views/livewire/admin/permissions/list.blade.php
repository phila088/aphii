<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;

new class extends Component {
    public Collection $permissions;

    public ?Permission $editing = null;

    public string $search;

    public function mount(): void
    {
        $this->getPermissions();
    }

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

<div class="tw-shadow-md tw-rounded-lg tw-p-6">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <h1 class="tw-text-lg">All permissions</h1>
        <div>
            <label for="search" class="sr-only">Search</label>
            <input type="text" id="search" wire:model="search" class="tw-py-3 tw-px-4 tw-block w-full tw-border-gray-200 tw-rounded-lg text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
        </div>
    </div>
    <div class="tw-divide-y tw-divide-gray-300 dark:tw-divide-gray-600">
        @if (!empty($permissions[0]))
            @foreach ($permissions as $permission)
                <div class="tw-p-6 tw-flex tw-space-x-2" wire:key="{{ $permission->id }}">
                    <div class="tw-flex-1">
                        <div class="tw-flex tw-justify-between tw-items-center">
                            <div>
                                <small class="ml-2 text-xs text-gray-600">{{ $permission->created_at->format('j M Y, g:i a') }}</small>
                                @unless ($permission->created_at->eq($permission->updated_at))
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
                                    <x-dropdown-link wire:click="edit({{ $permission->id }})">
                                        {{ __('Edit') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link wire:click="delete({{ $permission->id }})" wire:confirm="Are you sure to delete this permission?">
                                        {{ __('Delete') }}
                                    </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        @if ($permission->is($editing))
                            <livewire:admin.permissions.edit :permission="$permission" :key="$permission->id" />
                        @else
                            <p class="mt-0.5 text-sm text-gray-900">{{ $permission->name }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="tw-min-h-60 tw-flex tw-flex-col tw-bg-white tw-border tw-shadow-sm tw-rounded-xl dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-shadow-slate-700/[.7]">
                <div class="tw-flex tw-flex-auto tw-flex-col tw-justify-center tw-items-center tw-p-4 md:tw-p-5">
                    <svg class="tw-size-10 tw-text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" x2="2" y1="12" y2="12"/>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                        <line x1="6" x2="6.01" y1="16" y2="16"/>
                        <line x1="10" x2="10.01" y1="16" y2="16"/>
                    </svg>
                    <p class="tw-mt-5 tw-text-sm tw-text-gray-800 dark:tw-text-gray-300">
                        No data to show
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
