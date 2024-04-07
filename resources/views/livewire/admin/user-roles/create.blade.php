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

        if (!empty($matches[1])) {
            $user = User::where('email', '=', $matches[1])
                ->get();

            $role = Role::where('name', '=', $this->role)
                ->get();

            $user[0]->syncRoles($role[0]);

            $this->dispatch('user-role-created');

            $this->user = '';
            $this->role = '';
        } else {
            $this->dispatch('error');
        }
    }
}; ?>

<div">
    <form wire:submit="createUserRole" class="needs-validation" novalidate autocomplete="off">
        <div class="card custom-card">
            <div class="card-header">
                <h2>Assign a user a role</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="form-group">
                            <label for="user">User</label>
                            <input id="user" wire:model.live="user" class="form-control" list="users-list" x-on:input="$wire.updateUsers($el.value)" />
                            <datalist id="users-list">
                                <option></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->name }} <{{ $user->email }}>">{{ $user->name }} <{{ $user->email }}></option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <x-select cols="col-5" id="role" model="role" label="role">
                        <option></option>
                        @foreach ($roles as $role)
                            <option vlaue="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
            <div class="card-footer">
                <x-submit id="user-role-create" />
            </div>
        </div>
    </form>
</div>
