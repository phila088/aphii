<?php

use App\Models\User;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Collection;

new class extends Component {
    public ?Collection $userRoles;

    public string $search_term;

    public function mount(): void
    {
        $this->getUserRoles();

    }

    #[On('user-created')]
    #[On('role-created')]
    #[On('user-role-created')]
    public function getUserRoles(): void
    {
        $userRoles = DB::table('model_has_roles')
            ->orderBy('role_id')
            ->orderBy('model_id')
            ->get();

        $arr = [];

        foreach ($userRoles as $v) {
            $user = User::where('id', $v->model_id)
                ->get();
            $role = DB::table('roles')->where('id', $v->role_id)
                ->get();
            $arr[] = [
                'user' => $user[0],
                'role' => $role[0],
            ];
        }

        $this->userRoles = collect($arr);
    }

    public function delete(int $userId, int $roleId): void
    {
        $this->authorize('mode_has_roles.delete');

        DB::table('model_has_roles')
            ->where('model_id', $userId)
            ->where('role_id', $roleId, 'and')
            ->delete();

        $this->getUserRoles();
    }
}; ?>

<div>
    <div class="card custom-card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center w-100">
                <h2>All User Roles</h2>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($userRoles as $key => $userRole)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="col-auto">
                                <table class="table table-sm table-borderless">
                                    <tbody>
                                    <tr>
                                        <th>User: </th>
                                        <td>{{ $userRole['user']->name }} &lt;{{ $userRole['user']->email }}&gt;</td>
                                    </tr>
                                    <tr>
                                        <th>Role: </th>
                                        <td>{{ $userRole['role']->name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                @can ('brands.delete')
                                    <button type="button" class="btn btn-icon btn-sm btn-danger-light rounded-pill btn-wave waves-effect waves-light" wire:click.prevent="delete({{ $userRole['user']->id }}, {{ $userRole['role']->id }})" wire:confirm="Are you sure you want to delete this brand?"><i class="bi bi-trash"></i></button>
                                @endcan
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
