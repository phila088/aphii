<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $users;
    public Collection $roles;

    public string $user = '';
    public string $role = '';
    public string $email = '';

    public function mount(): void
    {
        $this->getUsers();
        $this->getRoles();
    }

    #[On('user-role-created')]
    public function getUsers(): void
    {
        $this->users = User::orderBy('name')->get();
    }

    public function getRoles(): void
    {
        $this->roles = Role::orderBy('name')
            ->get();
    }

    public function updateUsers(string $partial): void
    {
        if (empty($partial)) {
            $this->getUsers();
        } else {
            $this->users = User::where('name', 'like', '%' . $partial . '%')
                ->orWhere('email', 'like', '%' . $partial . '%')
                ->get();
        }
    }

    public function createUserRole(): void
    {
        $email = preg_match('/<(.*)>/i', $this->user, $matches);

        $user = User::where('email', '=', $matches[1])
            ->get();

        $role = Role::where('name', '=', $this->role)
            ->get();

        $user[0]->syncRoles($role[0]);

        $this->dispatch('user-role-created');

        $this->user = '';
        $this->role = '';
    }
}; ?>

<div class="tw-shadow-md tw-rounded-lg tw-p-4">
    <form wire:submit="createUserRole" class="needs-validation" novalidate autocomplete="off">
        <div class="row g-2">
            <div class="col-lg-3">
                <div class="form-floating">
                    <input id="user" wire:model.live="user" placeholder="User" class="form-control" list="users-list" x-on:input="$wire.updateUsers($el.value)" />
                    <label for="user">User</label>
                </div>
                <datalist id="users-list">
                    <option></option>
                    @foreach ($users as $user)
                        <option value="{{ $user->name }} <{{ $user->email }}>">{{ $user->name }} <{{ $user->email }}></option>
                    @endforeach
                </datalist>
            </div>

            <div class="col-lg-2">
                <div class="form-floating">
                    <select id="role" wire:model="role" class="form-select">
                        <option></option>
                        @foreach ($roles as $role)
                            <option vlaue="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <label for="role">Role</label>
                </div>
            </div>

        </div>

        <x-submit id="user-role-create" />
    </form>
</div>
