<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $users;

    public ?User $editing = null;

    public string $search;

    public function mount(): void
    {
        $this->getUsers();
    }

    #[On('user-created')]
    public function getUsers(): void
    {
        $this->search = '';

        $this->users = User::orderBy('name')
            ->get();
    }

    public function searchResults(string $partial): void
    {
        if (!empty($partial)) {
            switch (strtolower($partial)) {
                case 'admin':
                    $this->users = User::where('is_admin', '=', true)
                        ->orderBy('name')
                        ->get();
                    break;
                case 'client':
                    $this->users = User::where('is_client', '=', true)
                        ->orderBy('name')
                        ->get();
                    break;
                case 'employee':
                    $this->users = User::where('is_employee', '=', true)
                        ->orderBy('name')
                        ->get();
                    break;
                case 'vendor':
                    $this->users = User::where('is_vendor', '=', true)
                        ->orderBy('name')
                        ->get();
                    break;
                default:
                    $this->users = User::where('name', 'like', '%' . $partial . '%')
                        ->orWhere('email', 'like', '%' . $partial . '%')
                        ->orderBy('name')
                        ->get();
            }
        } else {
            $this->getUsers();
        }
    }

    public function edit(User $user): void
    {
        $this->editing = $user;

        $this->getUsers();
    }

    #[On('user-edit-canceled')]
    #[On('user-updated')]
    public function disableEditing(): void
    {
        $this->editing = null;

        $this->getUsers();
    }

    public function lock(User $user): void
    {
        $user->update([
            'locked' => true
        ]);

        $this->getUsers();
    }

    public function unlock(User $user): void
    {
        $user->update([
            'locked' => false
        ]);

        $this->getUsers();
    }

    public function activate(User $user): void
    {
        $user->update([
            'active' => true
        ]);

        $this->getUsers();
    }

    public function deactivate(User $user): void
    {
        $user->update([
            'active' => false
        ]);

        $this->getUsers();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="tw-flex tw-justify-between tw-items-center">
                <h1>All users</h1>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="list-users-search" wire:model="search" class="tw-py-2 tw-px-3 tw-block tw-w-full tw-border-gray-200 tw-rounded-full tw-text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tw-divide-y dark:tw-divide-gray-700">
                @can('users.viewany')
                    @empty($users[0])
                        <x-no-data />
                    @else
                        @foreach ($users as $user)
                            <div class="row g-2">
                                <div class="card-body tw-flex tw-align-top">
                                    @if (!is_null($user->last_activity) && Carbon::create($user->last_activity)->between(now()->subtract('5 minutes'), now()))
                                        <p class="avatar avatar-xxl avatar-rounded online me-3 my-auto">
                                            <img src="{{ asset($user->profile_picture_path) }}" alt="">
                                        </p>
                                    @else
                                        <p class="avatar avatar-xxl avatar-rounded offline me-3 my-auto">
                                            <img src="{{ asset($user->profile_picture_path) }}" alt="">
                                        </p>
                                    @endif
                                    <div class="flex-fill main-profile-info my-auto">
                                        <h2>
                                            {{ $user->name }}
                                        </h2>
                                        <div>
                                            <p class="text-muted">
                                                {{ $user->email }}
                                            </p>
                                            <p class="text-muted">
                                                @if ($user->is_admin)
                                                    Admin
                                                @elseif ($user->is_client)
                                                    Client
                                                @elseif ($user->is_employee)
                                                    Employee
                                                @elseif ($user->is_vendor)
                                                    Vendor
                                                @endif
                                            </p>
                                            <p class="text-muted">Last seen:
                                                @if (!is_null($user->last_activity))
                                                    {{ Carbon::parse($user->last_activity)->timezone($user->timezone)->diffForHumans() }}
                                                @else
                                                    Never
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="main-profile-info ms-auto">
                                        <div>
                                            @can('users.edit')
                                                <x-dropdown>
                                                    <x-slot name="trigger">
                                                        <button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="tw-h-4 tw-w-4 tw-text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                    </x-slot>
                                                    <x-slot name="content">
                                                        <x-dropdown-link wire:click="edit({{ $user->id }})">
                                                            {{ __('Edit') }}
                                                        </x-dropdown-link>
                                                        @if ($user->locked)
                                                            <x-dropdown-link wire:click="unlock({{ $user->id }})">
                                                                {{ __('Unlock') }}
                                                            </x-dropdown-link>
                                                        @else
                                                            <x-dropdown-link wire:click="lock({{ $user->id }})">
                                                                {{ __('Lock') }}
                                                            </x-dropdown-link>
                                                        @endif
                                                        @if ($user->active)
                                                            <x-dropdown-link wire:click="deactivate({{ $user->id }})">
                                                                {{ __('Deactivate') }}
                                                            </x-dropdown-link>
                                                        @else
                                                            <x-dropdown-link wire:click="activate({{ $user->id }})">
                                                                {{ __('Activate') }}
                                                            </x-dropdown-link>
                                                        @endif
                                                    </x-slot>
                                                </x-dropdown>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @if ($user->is($editing))
                                    <div class="row g-2 mb-4">
                                        <livewire:admin.users.edit :user="$user" :key="$user->id" />
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endempty
                @else
                    <x-not-auth />
                @endcan
            </div>
        </div>
    </div>
</div>
