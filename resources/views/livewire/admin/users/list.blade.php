<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $users;

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
}; ?>

<div class="tw-shadow-md tw-rounded-lg tw-p-6">
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div></div>
        <div>
            <label for="search" class="sr-only">Search</label>
            <input type="text" id="search" wire:model="search" class="tw-py-3 tw-px-4 tw-block w-full tw-border-gray-200 tw-rounded-lg text-sm focus:tw-border-blue-500 focus:tw-ring-blue-500 disabled:tw-opacity-50 disabled:tw-pointer-events-none dark:tw-bg-slate-900 dark:tw-border-gray-700 dark:tw-text-gray-400 dark:focus:tw-ring-gray-600" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
        </div>
    </div>
    @if (!empty($users[0]))
        @foreach ($users as $user)
            <div class="tw-p-6 tw-flex tw-space-x-2" wire:key="{{ $user->id }}">
                <div class="tw-grid tw-grid-flow-row tw-justify-center tw-items-center">
                    @if (!is_null($user->last_activity) && Carbon::create($user->last_activity)->between(now()->subtract('5 minutes'), now()))
                        <span class="avatar avatar-rounded avatar-xxl online">
                            <img src="{{ asset($user->profile_picture_path) }}" alt="">
                        </span>
                    @else
                        <span class="avatar avatar-rounded avatar-xxl offline">
                            <img src="{{ asset($user->profile_picture_path) }}" alt="">
                        </span>
                    @endif
                </div>
                <div class="tw-flex-1 tw-divide-y">
                    <div class="tw-flex tw-justify-between tw-items-center">
                        <div>
                            <span class="tw-text-gray-800 dark:tw-text-gray-300 tw-text-lg tw-font-bold">{{ $user->name }}</span>
                        </div>
                    </div>
                    <div class="tw-mt-0.5 tw-flex tw-flex-col">
                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300 tw-font-bold">Email: </p>
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">{{ $user->email }}</p>
                        </div>

                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300 tw-font-bold">User type: </p>
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">
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
                        </div>

                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300 tw-font-bold">Created: </p>
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">{{ $user->created_at->setTimezone($user->timezone)->format('j M Y, g:i a') }}</p>
                        </div>

                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300 tw-font-bold">Updated: </p>
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">{{ $user->updated_at->timezone($user->timezone)->format('j M Y, g:i a') }}</p>
                        </div>

                        <div class="tw-flex tw-flex-row tw-space-x-2">
                            <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300 tw-font-bold">Last seen: </p>
                            @if (!is_null($user->last_activity))
                                <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">{{ Carbon::parse($user->last_activity)->timezone($user->timezone)->diffForHumans() }}</p>
                            @else
                                <p class="tw-text-md tw-text-gray-900 dark:tw-text-gray-300">Never</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <x-no-data />
    @endif

</div>
