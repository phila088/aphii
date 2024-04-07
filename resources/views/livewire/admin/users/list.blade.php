<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

new class extends Component {
    public Collection $users;

    public ?User $editing = null;

    public string $search_term;

    public function mount(): void
    {
        $this->getUsers();
    }

    #[On('user-created')]
    public function getUsers(): void
    {
        $this->search_term = '';

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
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All users</h2>
                <div>
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" id="list-users-search" wire:model="search" class="form-control form-control-sm rounded-pill" placeholder="Search" x-on:input="$wire.searchResults($el.value);">
                </div>
            </div>
        </div>
        <div class="card-body">
            @canany (['users.viewAny', 'user.view'])
                <ul class="list-group">
                    @empty ($users[0])
                        <x-no-data />
                    @else
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-auto">
                                            @if (!is_null($user->last_activity) && Carbon::create($user->last_activity)->between(now()->subtract('5 minutes'), now()))
                                                <p class="avatar avatar-xxl avatar-rounded online my-auto">
                                                    <img src="{{ asset($user->profile_picture_path) }}" alt="">
                                                </p>
                                            @else
                                                <p class="avatar avatar-xxl avatar-rounded offline my-auto">
                                                    <img src="{{ asset($user->profile_picture_path) }}" alt="">
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-auto">
                                            <table class="table table-sm table-borderless">
                                                <tbody>
                                                <tr>
                                                    <th>Name: </th>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email: </th>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>User type: </th>
                                                    <td>
                                                        @if ($user->is_admin)
                                                            Admin
                                                        @elseif ($user->is_client)
                                                            Client
                                                        @elseif ($user->is_employee)
                                                            Employee
                                                        @elseif ($user->is_vendor)
                                                            Vendor
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Last seen: </th>
                                                    <td>
                                                        @if (!is_null($user->last_activity))
                                                            {{ Carbon::parse($user->last_activity)->timezone($user->timezone)->diffForHumans() }}
                                                        @else
                                                            Never
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div>
                                        @can ('users.edit')
                                            <button type="button" class="btn btn-icon btn-sm btn-info-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="edit({{ $user->id }})"><i class="bi bi-pencil"></i></button>
                                        @endcan
                                        @can ('users.delete')
                                            <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $user->id }})"><i class="bi bi-trash"></i></button>
                                        @endcan
                                    </div>
                                </div>
                                @if ($user->is($editing))
                                    <livewire:admin.users.edit :user="$user" :key="$user->id" />
                                @endif
                            </li>
                        @endforeach
                    @endempty
                </ul>
            @else
                <x-not-auth />
            @endcanany
        </div>
    </div>
</div>
